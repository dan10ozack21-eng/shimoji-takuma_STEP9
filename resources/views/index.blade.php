<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset="UTF-8">
        <title>商品一覧</title>
    </head>
    <body>
        <h1>商品一覧</h1>

        <table border="1">
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
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->explanation }}</td>
                    <td>{{ $product->image }}</td>
                    <td>{{ $product->price }}</td>
                </tr>
                @endforeach
            </tbody>
    </body>
</html>