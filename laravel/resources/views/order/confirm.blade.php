@extends('layouts.bootstrap')

@section('content')
<!-- Masthead-->
<header class="masthead masthead-slim">
    <div class="container">
        <div class="masthead-subheading">ご注文</div>
    </div>
</header>
<section class="page-section">
    <div class="container">
        <form action="/order/complete" method="POST">
            @csrf
            <h2>ご注文情報</h2>
            <div class="row">
                <div class="col-md-2">ご注文商品</div>
                <div class="col-md-6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>商品</th>
                                <th>単価</th>
                                <th>点数</th>
                                <th>税額</th>
                                <th>小計</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>商品AA</td>
                                <td class="text-end">1000円</td>
                                <td class="text-end">1</td>
                                <td class="text-end">(10%) 100円</td>
                                <td class="text-end">1100円</td>
                            </tr>
                            <tr>
                                <td colspan="4">配送料</td>
                                <td class="text-end">990円</td>
                            </tr>
                            <tr>
                                <td colspan="4">合計</td>
                                <td class="text-end">2090円</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h2>発送先</h2>
            <div class="row">
                <div class="col-md-2">お名前</div>
                <div class="col-md-10">{{ $ibTEcJ8uRTVsKCWrtW7R }}</div>
                <input type="hidden" name="ibTEcJ8uRTVsKCWrtW7R" value="{{ $ibTEcJ8uRTVsKCWrtW7R }}">
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
            <h2>お支払い</h2>
            <div class="row">
                <div class="col-md-2">支払方法</div>
                <div class="col-md-10">{{ $payment_name }}</div>
                <input type="hidden" name="payment" value="{{ $payment }}">
            </div>
            <br>
            <br>
            <input type="hidden" name="password" value="{{ $password }}">
            <input type="hidden" name="password_confirmation" value="{{ $password }}">
            <input type="hidden" name="kiyaku" value=1>
            <input type="hidden" name="product_id" value="{{ $product_id }}">
            <input type="hidden" name="orders" value="1">
            <button type="submit" class="btn btn-secondary" name="action" value="back">修正する</button>
            <button type="submit" class="btn btn-primary" name="action">注文する</button>
        </form>
    </div>
</section>
@endsection
