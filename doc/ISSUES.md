# issue 一覧

各ファイルの内容を１つずつissueとしてコピーします。  
画像も一緒にコピーしていきましょう。  

コピーしながら、[Markdown](https://docs.github.com/ja/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax)の書き方と[Mermaid](https://docs.github.com/ja/get-started/writing-on-github/working-with-advanced-formatting/creating-diagrams)の書き方を学びましょう！

※【2日】などと記載された数字は、一般的な2年目プログラマーに作業を割り振る場合の、だいたいの構築目安日数を独断で記載いたしました。来年はフォロー無しでもこのくらいの日数でできるようになるんだなあと想像してもらえるといいと思います。  

合計工数：22人日

※22人日が、動画全部の時間よりも長いとお考えのみなさま。正解です。この工数には「考える時間」が含まれていますが、動画では考えたり調査する時間が入っていません。結果のみをお伝えしていますので、工数よりも大幅に短くなっています。  

## 1 環境準備

- [開発環境の起動確認](./issues/1/develop-env.md)

## 2 設計書の読み方、env、データの作成

- [商品データの追加](./issues/2/add-product-data.md)

## 3 データの作成

- [注文データの追加](./issues/3/add-order-data.md)

1 環境準備～3 データの作成までで【1日】

## 4 ルーティングとController

- [会社情報ページの追加](./issues/4/add-company.md)
- [利用規約ページの追加](./issues/4/add-terms.md)
- [プライバシーポリシーページの追加](./issues/4/add-privacy.md)

3ページ追加で、【0.5日】

## 5 Ajax

- [郵便番号をいれたら自動的にフォームに都道府県・市区町村まで入力されるようにする](./issues/5/ajax.md)【2日】

## 6 ValidationとFormRequest

- [マイページ・発送先変更機能の追加](./issues/6/edit-profile.md)【2日】
- [お問い合わせフォームの追加](./issues/6/contact.md)【2日】

## 7 Pagination、メール送信

- [管理画面・注文履歴にページングを追加](./issues/7/admin-orders.md)【0.5日】
- [管理画面・商品一覧の追加](./issues/7/admin-products.md)【1日】
- [管理画面・カテゴリー一覧の追加](./issues/7/admin-categories.md)【1日】

## 8 画像アップロード機能の設計と構築、storage

- [管理画面・商品情報登録画面の作成](./issues/8/admin-create-product.md)
- [管理画面・商品情報変更画面の作成](./issues/8/admin-edit-product.md)

2つで【2日】

## 9 複雑な検索の設計と構築

- [管理画面・注文履歴に検索機能を追加](./issues/9/admin-search-orders.md)【1日】

## 10 ランキング機能の設計と構築

- [トップページの商品６点を、１カ月の売上順にする](./issues/10/ranking.md)【1日】
- [商品一覧ページを追加](./issues/10/products.md)【1日】

## 11 Stripeの導入

- [クレジットカード決済の導入](./issues/11/stripe.md)【5日】

## 12 削除機能と論理削除

- [管理画面・注文キャンセル機能の追加](./issues/12/admin-cancel-order.md)【0.5日】
- [管理画面・商品停止機能の追加](./issues/12/admin-stop-product.md)【0.5日】
- [管理画面・カテゴリー追加機能](./issues/12/admin-create-category.md)【0.5日】
- [管理画面・カテゴリー削除機能の追加](./issues/12/admin-delete-category.md)【0.5日】
