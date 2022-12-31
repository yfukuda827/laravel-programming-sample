# Laravelプログラマー養成＆マナー講座用サンプルプロジェクト

[株式会社RedoIT](https://redoit.tech)が開催する「Laravelプログラマー養成＆マナー講座」では、本プロジェクトを利用して開発を行っていく過程を学習していきます。

## 開発環境の作成方法

[Docker環境構築方法](./doc/DOCKER_USAGE.md) にまとめました。  

### 開発環境 URL

- [http://localhost:8000/](http://localhost:8000/) Web
  - テストアカウント test@redoit.tech / password
- [http://localhost:8000/admin-login-view](http://localhost:8000/admin/login) 管理画面
  - 管理者アカウント admin / password
- [http://localhost:8880/](http://localhost:8880/) phpMyAdmin
- [http://localhost:8025/](http://localhost:8025/) MailHog

## 非機能要件

[非機能要件](./doc/NON_FUNCTIONAL_REQUIREMENT.md) にまとめました。  
開発者も非機能要件を把握し、処理速度やサービス持続性について意識しましょう。  

## ログ出力

ログをどのように出力するのか、[ログ出力基準](./doc/LOG_DESIGN.md) にまとめました。
