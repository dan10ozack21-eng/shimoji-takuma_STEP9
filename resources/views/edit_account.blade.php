<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>アカウント編集</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container mb-4" style="max-width: 600px;">

    <h1 class="mb-4 fw-bold">アカウント情報編集</h1>

    <form action="{{ route('update_account')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">ユーザー名</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Eメール</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="mb-3">
            <label for="name_kanji" class="form-label fw-semibold">名前</label>
            <input type="text" id="name_kanji" name="name_kanji" class="form-control" value="{{ $user->name_kanji }}">
        </div>

        <div class="mb-3">
            <label for="name_kana" class="form-label fw-semibold">カナ</label>
            <input type="text" id="name_kana" name="name_kana" class="form-control" value="{{ $user->name_kana }}">
        </div>

        <div class="d-flex gap-3 mt-4">
            <a href="{{ route('mypage') }}" class="btn btn-secondary px-3 w-auto">マイページに戻る</a>
            <button type="submit" class="btn btn-primary px-4 w-auto">更新</button>
        </div>
    </form>

    </body>
</html>