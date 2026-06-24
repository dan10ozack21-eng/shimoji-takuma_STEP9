@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品登録</h1>
    <form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="product_name" class="form-label fw-semibold">商品名</label>
            <input type="text" id="product_name" name="product_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label fw-semibold">価格</label>
            <input type="number" id="price" name="price" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">商品説明</label>
            <textarea id="description" name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label fw-semibold">在庫数</label>
            <input type="number" id="stock" name="stock" class="form-control">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fw-semibold">商品画像</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>
        
        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('mypage') }}" class="btn btn-secondary px-2 w-auto">マイページに戻る</a>
            <button type="submit" class="btn btn-primary px-2 w-auto">登録</button>
        </div>
    </form>
</div>
@endsection