<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>【出品者用】商品詳細確認 - {{ $product->product_name }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container mt-4" style="max-width: 800px;">
        <h1>出品商品詳細</h1>

        <div class="mt-4">
            <p>商品名：{{ $product->product_name }}</p>
            <p>説明：{{ $product->description }}</p>
            <p>画像：
                @if($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid" style="max-width: 300px;">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light text-muted border rounded" style="height: 300px;">
                    画像なし
                </div>
            @endif
            </p>
            <p>金額：¥{{ $product->price }}</p>
        </div>

        <div class="d-flex mt-3 gap-3 px-3">
            <a href="{{ route('mypage_product_edit', $product->id) }}" class="btn btn-primary">編集</a>
            <form action="{{ route('mypage_product_destroy', ['id' => $product->id]) }}" method="POST" onsubmit="return confirm('本当にこの商品を削除してもよろしいですか？');">
                @csrf
                <button type="submit" class="btn btn-danger">削除する</button>
            </form>
            <a href="{{ route('mypage') }}" class="btn btn-secondary">戻る</a>
        </div>
    </body>
</html>