@extends('layouts.bootstrap')

@section('content')
<!-- Masthead-->
<header class="masthead masthead-slim">
    <div class="container">
        <div class="masthead-subheading">会員登録</div>
    </div>
</header>
<section class="page-section">
    <div class="container">
        <form action="/register/complete" method="POST">
            @csrf
            <h2>発送先</h2>
            <div class="row">
                <div class="col-md-2">お名前</div>
                <div class="col-md-10">{{ $RcyEjhgrjvQ9brh8aHQW }}</div>
                <input type="hidden" name="RcyEjhgrjvQ9brh8aHQW" value="{{ $RcyEjhgrjvQ9brh8aHQW }}">
                <input type="hidden" name="name">
            </div>
            <div class="row">
                <div class="col-md-2">メールアドレス</div>
                <div class="col-md-10">{{ $email }}</div>
                <input type="hidden" name="email" value="{{ $email }}">
            </div>
            <div class="row">
                <div class="col-md-2">お電話番号</div>
                <div class="col-md-10">{{ $tel }}</div>
                <input type="hidden" name="tel" value="{{ $tel }}">
            </div>
            <div class="row">
                <div class="col-md-2">住所</div>
                <div class="col-md-10">{{ $postcode }} {{ $prefecture }} {{ $address }} {{ $building }}</div>
                <input type="hidden" name="postcode" value="{{ $postcode }}">
                <input type="hidden" name="prefecture_id" value="{{ $prefecture_id }}">
                <input type="hidden" name="address" value="{{ $address }}">
                <input type="hidden" name="building" value="{{ $building }}">
            </div>
            <br>
            <br>
            <input type="hidden" name="password" value="{{ $password }}">
            <input type="hidden" name="password_confirmation" value="{{ $password }}">
            <input type="hidden" name="kiyaku" value=1>
            <button type="submit" class="btn btn-secondary" name="action" value="back">修正する</button>
            <button type="submit" class="btn btn-primary" name="action">会員登録する</button>
        </form>
    </div>
</section>
@endsection
