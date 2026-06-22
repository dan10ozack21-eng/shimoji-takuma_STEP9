<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4" style="max-width: 600px;">
    <h1 class="mb-4 fw-bold">お問い合わせフォーム</h1>
    
    <form action="{{ route('send_contact') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">お名前</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label fw-semibold">お問い合わせ内容</label>
            <textarea id="contact" name="contact" class="form-control" rows="5"></textarea>
        </div>

        <div class="d-flex gap-3 mb-2">
            <button type="submit" class="btn btn-primary px-3 w-auto">送信</button>
            <a href="{{ route('index')}}" class="btn btn-secondary px-3 w-auto">戻る</a>
        </div>
    </form>
</body>
</html>