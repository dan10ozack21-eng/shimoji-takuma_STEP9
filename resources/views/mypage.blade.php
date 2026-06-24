@extends('layouts.app')

@section('content')
<div class="container">
        <h1>マイページ</h1>

        @if (session('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <a href="{{ route('edit_account') }}" class="btn btn-primary px-3 mt-2">アカウント編集</a>
        <div class="d-flex gap-5 mt-3">
            <div class="d-flex flex-column">
                <span>ユーザー名：{{ $user->name }}</span>
                <span>Eメール：{{ $user->email }}</span>
            </div>
            <div class="d-flex flex-column">
                <span>名前：{{ $user->name_kanji }}</span>
                <span>カナ：{{ $user->name_kana ?? '(未登録)' }}</span>
            </div>
        </div>

        <h3 class=mt-5>＜出品商品＞</h3>
        <div class="d-flex justify-content-end">
            <a href="{{ route('create_product') }}" class="btn btn-primary">新規登録</a>
        </div>
        <table class="table table-bordered align-middle mt-3">
            <thead>
                <tr>
                    <th>商品番号</th>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金(¥)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('mypage_product_detail', $product->id) }}" class="btn btn-success btn-sm">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="mt-5">＜購入した商品＞</h3>
        <table class="table table-bordered align-middle mt-3">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金(¥)</th>
                    <th>個数</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->product->product_name }}</td>
                    <td>{{ $sale->product->description }}</td>
                    <td>{{ $sale->product->price }}</td>
                    <td>{{ $sale->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection