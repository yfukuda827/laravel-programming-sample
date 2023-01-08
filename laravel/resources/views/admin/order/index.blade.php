@extends('layouts.admin')

@section('content')
<section class="page-section mt-4">
    <div class="container">
        <h2>注文一覧</h2>
        @if($orders)
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>購入日<br>ステータス</th>
                <th>お名前<br>電話番号</th>
                <th>ご住所</th>
                <th>商品</th>
                <th>請求金額</th>
            </tr>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('Y/m/d') }}<br>ご注文</td>
                <td>{{ $order->name }}<br>{{ $order->tel }}</td>
                <td>{{ $order->postcode }}<br>{{ $order->prefecture->name }} {{ $order->address }} {{ $order->building }}</td>
                <td><b>{{ $order->product_name }}</b><br>{{ $order->price }}円x{{ $order->orders }}点={{ $order->price * $order->orders }}円<br>税額（{{ $order->tax_rate }}%）{{ $order->tax }}円</td>
                <td>小計 {{ $order->subtotal }}円<br>配送料 {{ $order->shipping_charge }}円<br>合計 {{ $order->total }}円</td>
            </tr>
            @endforeach
        </table>
        @else
        注文はまだありません
        @endif
    </div>
</section>
@endsection
