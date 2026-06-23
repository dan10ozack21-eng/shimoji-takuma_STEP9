<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>【出品者用】出品商品編集 - {{ $product->product_name }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container mt-4" style="max-width: 800px;">
        <h1>出品商品編集</h1>

    <form action="{{ route('mypage_product_update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="product_name" class="form-label fw-semibold">商品名</label>
            <input type="text" id="product_name" name="product_name" class="form-control" value="{{ $product->product_name }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label fw-semibold">価格</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $product->price }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">商品説明</label>
            <textarea id="description" name="description" class="form-control" ">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label fw-semibold">在庫数</label>
            <input type="number" id="stock" name="stock" class="form-control" value="{{ $product->stock }}">
        </div>

        <div class="mb-3">
            <label for="img_path" class="form-label fw-semibold">商品画像</label>
                @if($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" class="img-fluid rounded border shadow-sm" alt="商品画像" style="max-height: 400px; object-fit: cover;">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light text-muted border rounded" style="height: 300px;">
                    画像なし
                </div>
                @endif
            <input type="file" id="img_path" name="img_path" class="form-control">
        </div>

        <div class="d-flex gap-3 mt-4">
            <a href="{{ route('mypage_product_detail', $product->id) }}" class="btn btn-secondary px-3 w-auto">戻る</a>
            <button type="submit" class="btn btn-primary px-4 w-auto">更新</button>
        </div>
    </form>

    </body>
</html>