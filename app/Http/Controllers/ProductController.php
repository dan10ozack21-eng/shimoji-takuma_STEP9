<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Like;
// use App\Models\Sales;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ContactRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::getAvailableList()->get();

        return view('index', compact('products'));
    }

    public function toggleLike($id)
    {
        $userId = Auth::id();

        Like::toggleLike($userId, $id);

        return redirect()->back();
    }

    public function create()
    {
        return view('create');
    }

    public function show($id)
    {
        $product = Product::findWithRelations($id, ['company', 'likes']);

        $isLiked = false;
        if (auth()->check()) {
            $isLiked = $product->likes->contains('user_id', auth()->id());
        }

        return view('detail', compact('product', 'isLiked'));
    }

    public function purchase($id)
    {
        $product = Product::findWithRelations($id, ['company']);

        return view('purchase', compact('product'));
    }

    public function completePurchase(Request $request, $id)
    {
        $product = Product::findWithRelations($id);

        $quantity = $request->input('quantity', 1);
        
        if ($product->stock < $quantity) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'error' => "在庫が不足しております。現在の在庫は{$product->stock}個です。"
                ], 400);
            }

            return redirect()->back()->with('error', "申し訳ありません。在庫が不足しております。(残り{$product->stock}個)");
        }

        $userId = auth()->check() ? auth()->id() : null;

        \App\Models\Sales::executePurchase($product->id, $quantity, $userId);

        $product->refresh();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => '購入が完了しました！',
                'product' => $product
            ], 200);
        }

        return redirect()->route('index')->with('success', '商品を購入しました！');
    }

    public function mypage()
    {
        $user = \Auth::user();
        $userId = \Auth::id();

        $products = Product::getMyProducts($userId)->get();
        $sales = \App\Models\Sales::getMypurchaseHistory($userId);

        return view('mypage', compact('user', 'products', 'sales'));
    }

    public function store(ProductRequest $request)
    {

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Product::createProduct($request->validated(), $imagePath, \Auth::id());

        return redirect()->route('mypage')->with('success', '商品が新しく登録されました！');
    }

    public function editAccount()
    {
        $user = \Auth::user();

        return view('edit_account', compact('user'));
    }

    public function updateAccount(UserRequest $request) 
    {
        \App\Models\User::updateAccountInfo(\Auth::id(), $request->validated());

        return redirect()->route('mypage')->with('success', 'アカウント情報を更新しました！');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(ContactRequest $request)
    {

        return redirect()->route('index')->with('success', 'お問い合わせを送信しました！');
    }

    public function showMyProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);

        return view('mypage_product_detail', compact('product'));
    }

    public function destroyProduct($id)
    {
        \App\Models\Product::deleteProduct($id);

        return redirect()->route('mypage')->with('success', '商品を削除しました。');
    }

    public function editMyProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);

        return view('mypage_product_edit', compact('product'));
    }

    public function updateMyProduct(ProductRequest $request, $id)
    {
        $imagePath = null;
        if ($request->hasFile('img_path')) {
            $imagePath = $request->file('img_path')->store('img_path', 'public');
        }

        \App\Models\Product::updateProductInfo($id, $request->validated(), $imagePath);

        return redirect()->route('mypage_product_detail', $id)->with('success', '出品商品情報の更新が完了しました！');
    }

    public function search(Request $request)
    {
        $products = Product::searchFilter($request->only(['product_name', 'min_price', 'max_price']))->get();

        return view('index', compact('products'));
    }
}
