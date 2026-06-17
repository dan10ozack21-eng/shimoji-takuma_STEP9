<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" contents="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>商品詳細</title>
    </head>

    <body>
        <h1>商品詳細</h1>
        <div class="container">
            <p>商品名：{{ $product->product_name }}<br>
            説明：{{ $product->description }}<br>
            画像：<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" class="img-fluid"><br>
            金額：{{ $product->price }}<br>
       <!-- 会社：{{ }} --> </p>
        </div>
    </body>
</html>