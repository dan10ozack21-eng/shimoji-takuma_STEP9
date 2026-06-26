@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ session('success') }}
    </div>
    @endif
    
        <h1>商品一覧</h1>

        <form action="{{ route('search') }}" method="GET" class="my-3">
            <div class="d-flex gap-4 px-2 align-items-center">
                <div class="col-4">
                    <input type="text" name="product_name" class="form-control" placeholder="商品名を入力" value="{{ request('product_name') }}">
                </div>

                <div class="col-4 d-flex align-items-center gap-2">
                    <input type="number" name="min_price" class="form-control" placeholder="最低価格" value="{{ request('min_price') }}" min="0">
                    <span>~</span>
                    <input type="number" name="max_price" class="form-control" placeholder="最高価格" value="{{ request('max_price') }}" min="0">
                </div>

                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </form>

        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>商品番号</th>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>画像</th>
                    <th>料金(¥)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                    @if($product->img_path) 
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                    @else
                    <span class="text-muted">なし</span>
                    @endif
                    </td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('detail', $product->id) }}" class="btn btn-primary">詳細</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">該当する商品はありません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
</div>
@endsection