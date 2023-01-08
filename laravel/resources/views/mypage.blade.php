@extends('layouts.bootstrap')

@section('content')
<!-- Masthead-->
<header class="masthead masthead-slim">
    <div class="container">
        <div class="masthead-subheading">マイページ</div>
    </div>
</header>
<section class="page-section">
    <div class="container">
        <div class="alert alert-success" role="alert">
            パスワードを変更しました。
        </div>
        <h2>発送先</h2>
        <div class="row">
            <div class="col-md-2">お名前</div>
            <div class="col-md-10">{{ $user->name }}</div>
        </div>
        <div class="row">
            <div class="col-md-2">お電話番号</div>
            <div class="col-md-10">{{ $user->profile->tel }}</div>
        </div>
        <div class="row">
            <div class="col-md-2">住所</div>
            <div class="col-md-10">{{ $user->profile->postcode }} {{ $prefecture }} {{ $user->profile->address }} {{ $user->profile->building }}</div>
        </div>
        <br>
        <br>
        <hr>
        <br>
        <h2>パスワード変更</h2>
        <br>
        <a href="change-password.html" class="btn btn-secondary">変更する</a>
        <br>
        <br>
        <hr>
        <br>
        <h2>注文履歴</h2>
        @if($orders)
        <div class="row">
            @foreach($orders as $order)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $order->product_name }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">価格: {{ $order->price }}yen</li>
                        <li class="list-group-item">注文点数: {{ $order->orders }}</li>
                        <li class="list-group-item">税額（{{ $order->tax_rate }}%）: {{ $order->tax }}yen</li>
                        <li class="list-group-item">小計: {{ $order->subtotal }}yen</li>
                        <li class="list-group-item">配送料: {{ $order->shipping_charge }}</li>
                        <li class="list-group-item">請求金額: {{ $order->total }}yen</li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        @else
        まだ注文はありません
        @endif
    </div>
</section>
@endsection

