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
        $products = Product::with('company');

        if (Auth::check()) {
            $products->where('user_id', '!=', Auth::id());
        }

        $products->orderBy('id', 'asc');

        $products = $products->get();
        
        return view('index', compact('products'));
    }

    public function toggleLike($id)
    {
        $userId = Auth::id();

        $like = Like::where('user_id', $userId)->where('product_id', $id)->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $userId,
                'product_id' => $id,
            ]);
        }

        return redirect()->back();
    }

    public function create()
    {
        return view('create');
    }

    public function show($id)
    {
        $product = Product::with(['company', 'likes'])->findOrFail($id);

        $isLiked = false;
        if (auth()->check()) {
            $isLiked = $product->likes->contains('user_id', auth()->id());
        }

        return view('detail', compact('product', 'isLiked'));
    }

    public function purchase($id)
    {
        $product = Product::with('company')->findOrFail($id);

        return view('purchase', compact('product'));
    }

    public function completePurchase(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $quantity = $request->input('quantity', 1);
        
        if ($product->stock <= $quantity) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'error' => "在庫が不足しております。現在の在庫は{$product->stock}個です。"
                ], 400);
            }

            return redirect()->back()->with('error', "申し訳ありません。在庫が不足しております。(残り{$product->stock}個)");
        }

        $product->decrement('stock', $quantity);

        $userId = auth()->check() ? auth()->id() : null;

        \App\Models\Sales::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

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
        // $user = Auth::user();

        $user = \Auth::user();

        $products = Product::where('user_id', \Auth::id())->orderBy('id', 'asc')->get();

        $sales = \App\Models\Sales::with('product')
        ->where('user_id', \Auth::id())
        ->orderBy('created_at', 'asc')
        ->get();

        return view('mypage', compact('user', 'products', 'sales'));
    }

    public function store(ProductRequest $request)
    {

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        \App\Models\Product::create([
            'user_id' => \Auth::id(),
            'company_id' => 1,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'img_path' => $imagePath,
        ]);

        return redirect()->route('mypage')->with('success', '商品が新しく登録されました！');
    }

    public function editAccount()
    {
        $user = \Auth::user();

        return view('edit_account', compact('user'));
    }

    public function updateAccount(UserRequest $request) 
    {

        $user = \App\Models\User::find(\Auth::id());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->name_kanji = $request->name_kanji;
        $user->name_kana = $request->name_kana;

        $user->save();

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
        $product = \App\Models\Product::findOrFail($id);

        $product->delete();

        return redirect()->route('mypage')->with('success', '商品を削除しました。');
    }

    public function editMyProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);

        return view('mypage_product_edit', compact('product'));
    }

    public function updateMyProduct(ProductRequest $request, $id)
    {

        $product = \App\Models\Product::find($id);

        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        if ($request->hasFile('img_path')) {
            $img_path = $request->file('img_path')->store('img_path', 'public');
            $product->img_path = $img_path;
        }

        $product->save();

        return redirect()->route('mypage_product_detail', $product->id)->with('success', '出品商品情報の更新が完了しました！');
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%'. $request->product_name . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->orderBy('id', 'asc')->get();

        return view('index', compact('products'));
    }
}
