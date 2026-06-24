<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
// use App\Models\Sales;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('company')->get();
        
        return view('index', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    public function show($id)
    {
        $product = Product::with(['company', 'likes'])->findOrFail($id);
        return view('detail', compact('product'));
    }

    public function purchase($id)
    {
        $product = Product::with('company')->findOrFail($id);

        return view('purchase', compact('product'));
    }

    public function mypage()
    {
        // $user = Auth::user();

        $user = \Auth::user();

        $products = Product::where('user_id', \Auth::id())->orderBy('id', 'asc')->get();

        $sales = collect([
            (object)[
                'quantity' => 10,
                'product' => (object)[
                    'product_name' => '鉛筆',
                    'description' => '描きやすい鉛筆です',
                    'price' => 200,
                ]
            ],
            (object)[
                'quantity' => 1,
                'product' => (object)[
                    'product_name' => 'イヤホン',
                    'description' => 'ワイヤレスです。',
                    'price' => 1000,
                ]
            ],
            (object)[
                'quantity' => 2,
                'product' => (object)[
                    'product_name' => 'タブレット',
                    'description' => '軽量です',
                    'price' => 25000,
                ]
            ],
            (object)[
                'quantity' => 5,
                'product' => (object)[
                    'product_name' => 'デスク',
                    'description' => '昇降できます',
                    'price' => 30000,
                ]
            ],
        ]);
        // Sale::with('product')
        // ->orderBy('created_at', 'asc')
        // ->get();

        return view('mypage', compact('user', 'products', 'sales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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

    public function updateAccount(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'name_kanji' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
        ]);

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

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'contact' => 'required|string',
        ]);

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

    public function updateMyProduct(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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
