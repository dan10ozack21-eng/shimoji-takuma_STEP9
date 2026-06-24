@extends('layouts.app')

@section('content')
<div class="container">
        <div class="container mt-4">
          <h1>商品詳細</h1>

          <div class="mt-4">
            <p>商品名：{{ $product->product_name }}</p>
            <p>説明：{{ $product->description }}</p>
            <p>画像：<br>
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid" style="max-width: 300px;">
            </p>
            <p>金額：¥{{ $product->price }}</p>
            <p>会社：{{ $product->company->company_name }} </p>
          </div>

          <div class="d-flex gap-2 mt-3">
            <a href="{{ route('purchase', $product->id) }}" class="btn btn-primary px-4">カートに追加する</a>

            <a href="{{ url('/index') }}" class="btn btn-secondary px-4">戻る</a>
          </div>
        </div>
</div>
@endsection