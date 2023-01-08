@extends('layouts.bootstrap')

@section('content')
<!-- Masthead-->
<header class="masthead masthead-slim">
    <div class="container">
        <div class="masthead-subheading">パスワードを変更</div>
    </div>
</header>
<section class="page-section">
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/mypage/edit-password/complete?XDEBUG_TRIGGER=1" method="POST">
            @csrf
            <h2>パスワード変更</h2>
            <div class="mb-3">
                <label for="input-password" class="form-label">現在のパスワード <spacn class="text-danger">*必須</span></label>
                <input type="password" name="password" class="form-control" id="input-password" required value="{{ old('password') }}">
                <div id="passwordHelp" class="form-text">8文字以上。半角英字の大文字と小文字、半角数字を少なとも1つずつ含めてください。</div>
            </div>
            <div class="mb-3">
                <label for="input-new-password" class="form-label">新しいパスワード <spacn class="text-danger">*必須</span></label>
                <input type="password" name="new_password" class="form-control" id="input-new-password" required value="{{ old('new_password') }}">
                <input type="password" name="new_password_confirmation" class="form-control" placeholder="もう一度パスワードをご入力ください" required>
                <div id="newPasswordHelp" class="form-text">8文字以上。半角英字の大文字と小文字、半角数字を少なとも1つずつ含めてください。</div>
            </div>

            <a href="/mypage" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary" name="action">パスワードを変更する</button>
        </form>
    </div>
</section>
@endsection
