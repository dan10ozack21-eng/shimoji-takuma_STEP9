@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <h1>商品詳細</h1>

            <div class="mt-4">
                <p><strong>商品名：</strong>{{ $product->product_name }}</p>
                <p><strong>説明：</strong>{{ $product->description }}</p>
                <p><strong>画像：</strong><br>
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid mt-2" style="max-width: 300px;">
                </p>
                <p><strong>金額：</strong>¥{{ $product->price }}</p>
                <p><strong>会社：</strong>{{ $product->company->company_name }} </p>
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

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('purchase', $product->id) }}" class="btn btn-primary px-4">カートに追加する</a>
                <a href="{{ url('/index') }}" class="btn btn-secondary px-4">戻る</a>
            </div>

        </div>
    </div>
</div>
@endsection