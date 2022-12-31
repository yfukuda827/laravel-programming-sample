# ログ出力基準

## Laravelのログレベル

emergency、alert、critical、error、warning、notice、info、debug

```php
use Illuminate\Support\Facades\Log;

Log::emergency($message);
Log::alert($message);
Log::critical($message);
Log::error($message);
Log::warning($message);
Log::notice($message);
Log::info($message);
Log::debug($message);
```

## 各環境での出力レベル

各環境で、以下のレベル以上のログを出力します

- 開発環境 : debug
- 検証環境 : info
- 本番環境 : notice

これらの設定は、 `env` ファイルで実施します。  

```.env
LOG_LEVEL=debug
```

## ログ出力内容について

以下のルールにてコーディングをお願いします。

| ログレベル | 定義 | 使用例 | 外部通知 |
|-----------|------|-------|---------|
| emergency | 基本的に使わない | - | - |
| alert | システムから外部接続する際の異常で、システム停止になるもの | DB接続、API接続エラー、ストレージ異常 | Chatwork へ通知 |
| critical | システム内部の異常で、システム停止になるもの | メール送信失敗、SQLの失敗、バッチの失敗 | Chatwork へ通知 |
| error | システムが原因で正常に処理ができないが、頻発しなければ未対応でもいいもの | キャッシュ異常 ||
| warning | ユーザー起因で正常に処理ができなかったようなもの | メールアドレス間違いなどのメール送信エラー（今は無いですがクレジットカードのエラーなど） ||
| notice | 正常に処理しているが、記録しておきたい重要なもの | 監査証跡 ||
| info | そこまで重要じゃないが記録しておきたいもの | SQLクエリ ||
| debug | 開発のデバッグ時に必要な情報 | validate済みのPOSTデータ、その他開発チームがよく確認するデータの中身など ||

## コーディングのメモ

### バッチ異常の記載

critical のエラーとします

サンプル

```php
$schedule->command('emails:send')
         ->daily()
         ->onSuccess(function (Stringable $output) {
            Log::notice('バッチ処理正常終了');
         })
         ->onFailure(function (Stringable $output) {
            Log::critical('バッチ異常 xxx');
         });
```

公式 [タスクスケジュール](https://readouble.com/laravel/8.x/ja/scheduling.html)
