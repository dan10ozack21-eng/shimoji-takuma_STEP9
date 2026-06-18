<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
}
