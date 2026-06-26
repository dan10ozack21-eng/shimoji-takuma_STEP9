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

          <div class="mt-3">
            @auth
            <form action="{{ route('products.toggle_like', $product->id) }}" method="POST">
              @csrf
              @if($isLiked)
              <button type="submit" class="btn text-danger p-0 border-0 shadow-none" style="font-size: 2rem; line-height: 1;">
                ♥
              </button>
              @else
              <button type="submit" class="btn text-muted p-0 border-0 shadow-none" style="font-size: 2rem; line-height: 1; transition: color 0.2s;" 
              onmouseover="this.style.color='#dc3545'" onmouseout="this.style.color='#6c757d'">
              ♡
              </button>
              @endif
            </form>
            @else
            <p class="text-muted small">※お気に入り機能を利用するには<a href="{{ route('login') }}">ログイン</a>が必要です。</p>
            @endauth
          </div>

          <div class="d-flex gap-2 mt-3">
            <a href="{{ route('purchase', $product->id) }}" class="btn btn-primary px-4">カートに追加する</a>

            <a href="{{ url('/index') }}" class="btn btn-secondary px-4">戻る</a>
          </div>
        </div>
</div>
@endsection