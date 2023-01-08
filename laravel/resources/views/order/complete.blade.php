@extends('layouts.bootstrap')

@section('content')
<!-- Masthead-->
<header class="masthead masthead-slim">
    <div class="container">
        <div class="masthead-subheading">ご注文ありがとうございます</div>
    </div>
</header>
<section class="page-section">
    <div class="container">
        <h2>ご注文メールを送信しました</h2>
        <p>ご入力いただいたメールアドレス宛てに、ご注文情報のメールを送信いたしました。<br>
        メールが届かない場合は、迷惑メールフォルダをご確認ください。<br>
        迷惑メールフォルダにもメールが届いていない場合は、000-0000-0000（担当：内川）までお電話ください。</p>
        <p>ご注文が確定するまですこしお時間をいただきます。いましばらくお待ちください。<br>
        このたびはご注文いただきまして、ありがとうございます。</p>
        <!-- 会員登録を同時に実行した場合 -->
        <p>メールアドレスの認証をおこなうメールを同時に送付いたしました。メール本文の中のリンクをクリックして、メールアドレスの認証をおこなってください。</p>
        </div>
</section>
@endsection
