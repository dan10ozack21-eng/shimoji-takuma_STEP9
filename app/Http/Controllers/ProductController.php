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

        $user = (object)[
            'name'       => 'Cy',
            'email'      => 'cy.com',
            'name_kanji' => '山田太郎',
            'name_kana'  => 'ヤマダタロウ'
        ];

        $products = Product::orderBy('id', 'asc')->get();

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
            'user_id' => 1,
            'company_id' => 1,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'img_path' => $imagePath,
        ]);

        return redirect()->route('mypage')->with('success', '賞品が新しく登録されました！');
    }
}
