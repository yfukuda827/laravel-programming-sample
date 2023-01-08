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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/order/confirm?XDEBUG_TRIGGER=1" method="POST">
            @csrf
            @if(!$user)
            <!-- 会員登録していないひと -->
            <!-- 会員登録している場合、パスワードとメールアドレスの表示をせず、profilesテーブルの情報がそのまま表示されます。 -->
            <p>ご入力いただいた情報をもとに、会員登録されます。</p>
            <div class="mb-3">
                <label for="input-name" class="form-label">お名前 <spacn class="text-danger">*必須</span></label>
                <input type="text" name="ibTEcJ8uRTVsKCWrtW7R" class="form-control" id="input-name" required value="{{ old('ibTEcJ8uRTVsKCWrtW7R') }}">
            </div>
                <div class="mb-3">
                <label for="input-password" class="form-label">パスワード <spacn class="text-danger">*必須</span></label>
                <input type="password" name="password" class="form-control" id="input-password" required value="{{ old('password') }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="もう一度パスワードをご入力ください" required>
                <div id="passwordHelp" class="form-text">8文字以上。半角英字の大文字と小文字、半角数字を少なとも1つずつ含めてください。</div>
            </div>
            <!-- この name はハニーポットです 入力されてはいけません -->
            <input type="text" name="name" value="" style="display:none;">
            <div class="mb-3">
                <label for="input-email" class="form-label">メールアドレス <spacn class="text-danger">*必須</span></label>
                <input type="email" name="email" class="form-control" id="input-email" aria-describedby="emailHelp" required value="{{ old('email') }}">
                <div id="emailHelp" class="form-text">ご注文情報を送付いたします。</div>
            </div>
            @endif
            <h2>発送先</h2>
            <p>発送先の住所と連絡先をご入力ください。</p>
            <div class="mb-3">
                <label for="input-tel" class="form-label">お電話番号 <spacn class="text-danger">*必須</span></label>
                <input type="tel" name="tel" class="form-control" id="input-tel" aria-describedby="telHelp" required value="{{ old('tel') }}">
                <div id="telHelp" class="form-text">ハイフンなしでご入力ください。複雑なご注文の場合に電話する場合があります。</div>
            </div>
            <div class="mb-3">
                <label for="input-postcode" class="form-label">郵便番号 <spacn class="text-danger">*必須</span></label>
                <input type="text" name="postcode" class="form-control" id="input-postcode" aria-decribeby="postcodeHelp" required value="{{ old('postcode') }}">
                <div id="postcodeHelp" class="form-text">ハイフンなし７桁でご入力ください。</div>
            </div>
            <div class="mb-3">
                <label for="input-prefecture" class="form-label">都道府県 <spacn class="text-danger">*必須</span></label>
                <select id="input-prefecture" name="prefecture_id" class="form-select" required>
                    <option selected>選択してください</option>
                    @foreach($prefectures as $prefecture_id => $pref_name)
                    <option value="{{ $prefecture_id }}" @if(old('prefecture_id') == $prefecture_id) selected @endif>{{ $pref_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="input-address" class="form-label">住所（市区町村・番地） <spacn class="text-danger">*必須</span></label>
                <input type="text" name="address" class="form-control" id="input-address" required value="{{ old('address') }}">
            </div>
            <div class="mb-3">
                <label for="input-building" class="form-label">住所（建物名・部屋番号）</label>
                <input type="text" name="building" class="form-control" id="input-building" value="{{ old('building') }}">
            </div>
 
            <h2>支払い</h2>
            <div class="mb-3">
                <label for="input-payment" class="form-label">支払方法</label>
                <select id="input-payment" name="payment" class="form-select" required>
                    <option selected>選択してください</option>
                    @foreach($payments as $payment_key => $payment_name)
                    <option value="{{ $payment_key }}" @if(old('payment') == $payment_key) selected @endif>{{ $payment_name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="alert alert-success">
                <div class="mb-3 form-check">
                    <input type="checkbox" name="kiyaku" class="form-check-input" id="input-check" value="1" @if(old('kiyaku') == 1) checked @endif>
                    <label class="form-check-label" for="input-check"><a class="text-black" href="/terms" target="_blank">利用規約</a>に同意する</label>
                </div>
            </div>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="orders" value="1">
            <button type="submit" class="btn btn-primary">入力内容を確認する</button>
        </form>
    </div>
</section>
@endsection
