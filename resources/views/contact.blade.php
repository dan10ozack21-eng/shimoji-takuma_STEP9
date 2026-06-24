@extends('layouts.app')

@section('content')
<div class="container">
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
</div>
@endsection