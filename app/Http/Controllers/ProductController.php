<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        return view('index', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    public function show($id)
    {
        $products = Product::findOrFail($id);
        return view('detail', compact('products'));
    }
}
