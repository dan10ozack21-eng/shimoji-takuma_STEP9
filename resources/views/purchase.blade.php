<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>購入画面</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4" style="max-width: 500px;">
            <h1>購入画面</h1>

            <div class="mt-4">
                 <p>商品名：{{ $product->product_name }}</p>
                 <p>説明：{{ $product->description }}</p>
                 <p>画像：<br>
                     <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" class="img-fluid" style="max-width: 300px;">
                 </p>
             <p>
                @if($product->stock >0)
                <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" class="form-control" style="width: 100px; display: inline-block;">
                @else
                <span class="text-danger font-weight-bold">申し訳ございません。現在、在庫がございません。</span>
                @endif
            </p>
            <p>金額：¥{{ $product->price }}</p>
            <p>残り：{{ $product->stock }}</p>
            <p>会社：{{ $product->company->company_name }} </p>
            </div>

            <form action="#" method="POST">
                @csrf 
                <div class="d-flex gap-2">
                    @if($product->stock >0)
                     <button type="submit" class="btn btn-primary px-4">購入する</button>
                     @else
                     <button type="button" class="btn btn-secondary px-4">売り切れ</button>
                     @endif
                     <a href="{{ route('detail', $product->id) }}" class="btn btn-secondary px-4">戻る</a>
                </div>
            </form>
        </div>
    </body>
</html>