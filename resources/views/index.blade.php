<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset="UTF-8">
        <title>商品一覧</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container mt-4">
        <h1>商品一覧</h1>

        <table border="table table-bordered">
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
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->img_path }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('detail', $product->id) }}" class="btn btn-primary">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>