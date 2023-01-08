{{ $user->name }} 様

このたびはご注文いただきまして、ありがとうございます。  
発送準備ができましたら、再度連絡させていただきます。

●ご注文番号
#{{ $order->id }}

●ご注文商品
商品AA {{ $order->price }}円×{{ $order->orders}} 点={{ $order->price * $order->orders }}円
税額（{{ $order->tax_rate }}％）{{ $order->tax }}円

●ご請求金額
小計 {{ $order->subtotal }}円
配送料 {{ $order->shipping_charge }}円
合計 {{ $order->total }}円

●発送先
お名前　{{ $user->name }}  
メール　{{ $user->email }}
電話番号　{{ $user->profile->tel }}
住所　{{ $user->profile->postcode }} {{ $prefecture }} {{ $user->profile->address }} {{ $user->profile->building }}

●お支払い
{{ $payment }}

---
本メールにご返信いただけます。  
本メールは https://start-bootstrap.jp より送付されました。
