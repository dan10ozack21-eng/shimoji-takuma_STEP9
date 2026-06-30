@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h1>出品商品詳細</h1>

            <div class="mt-4">
                <p><strong>商品名：</strong>{{ $product->product_name }}</p>
                <p><strong>説明：</strong>{{ $product->description }}</p>
                <p><strong>画像：</strong><br>
                    @if($product->img_path)
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid mt-2" style="max-width: 300px;">
                    @else
                    <div class="d-flex align-items-center justify-content-center bg-light text-muted border rounded mt-2" style="height: 300px; max-width: 300px;">
                        画像なし
                    </div>
                    @endif
                </p>
                <p><strong>金額：</strong>¥{{ $product->price }}</p>
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('mypage_product_edit', $product->id) }}" class="btn btn-primary px-4">編集</a>
                
                <form action="{{ route('mypage_product_destroy', ['id' => $product->id]) }}" method="POST" onsubmit="return confirm('本当にこの商品を削除してもよろしいですか？');">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4">削除する</button>
                </form>
                
                <a href="{{ route('mypage') }}" class="btn btn-secondary px-4">戻る</a>
            </div>

        </div>
    </div>
</div>
@endsection