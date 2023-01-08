@extends('layouts.bootstrap')

@section('content')
<!-- Masthead-->
<header class="masthead masthead-slim">
    <div class="container">
        <div class="masthead-subheading">ログイン</div>
    </div>
</header>
<section class="page-section">
    <div class="container">
        @isset($authgroup)
        <form method="POST" action="{{ url("login/$authgroup") }}">
        @else
        <form method="POST" action="{{ route('login') }}">
        @endisset
            @csrf
            <h2>ログイン</h2>
            <div class="mb-3">
                <label for="input-email" class="form-label">メールアドレス</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="input-password" class="form-label">パスワード</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <button type="submit" class="btn btn-success">ログイン</button>
        </form>
    </div>
</section>
@endsection
