# 郵便番号をいれたら自動的にフォームに都道府県・市区町村まで入力されるようにする

- ルーティング `POST /postcode` を追加します。このルートは、ログインしていなくてもアクセス可能です。
  - params `postcode` をリクエストします
    - `postcode` は必須です。半角数字のみ7桁です。ハイフンは無しとします。
  - responce は `prefecture` と `address` です。例を以下に記載します。
- 郵便番号の入力フォームの内容が変わったら（onchange）、Ajaxで通信して、都道府県市区町村を自動入力します。事前に入力があった場合などでも、警告等は一切無しです。  
- 入力された郵便番号に間違いがあったり、該当の郵便番号が無かった場合は、HTTP status 302になります。
- 郵便番号の元データは[こちら](https://www.post.japanpost.jp/zipcode/download.html)にある郵便番号データダウンロードから、[「読み仮名データの促音・拗音を小書きで表記するもの」](https://www.post.japanpost.jp/zipcode/dl/kogaki-zip.html)を利用します。
  - 全国一括CSVをダウンロードします。
- この機能を、注文と会員登録画面に設置します。

## 例

request

```txt
POST /postcode
    body 'postcode' = 1460082
```

response json  

```txt
'prefecture_id' => 13,
'address' => '大田区池上'
```

---

[<<一覧に戻る](../../ISSUES.md)
