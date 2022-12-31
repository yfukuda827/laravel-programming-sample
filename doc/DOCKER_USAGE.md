# 開発環境 Docker について

## 準備

docker と docker-compose が必要です。  
[Docker Desktop](https://docs.docker.jp/get-docker.html)を導入すれば両方インストールできます。  

## 初回起動

1password の "docker 用 .env ファイル" から .env をダウンロードします。
ダウンロードした .env を .env.docker に名前を変更後、
laravel/.env.docker に上書きします。

```sh
> cd THIS_REPOSITORY_DIR
> rm laravel/.env
> docker-compose up -d --build
> docker exec -it sample-laravel /mnt/.docker/laravel/clrcache.sh
> docker exec -it sample-laravel /mnt/.docker/laravel/firstexec.sh
```

- 現在、 `laravel/firstexec.sh` を実行するとDBのデータが初期化されます。データを削除したくない場合は、引数 `--nodb` をつけて実行してください。  

```sh
> docker exec -it sample-laravel /mnt/.docker/laravel/firstexec.sh --nodb
```

## 2回目以後の起動と終了

コンテナ起動

```sh
> docker-compose up -d
```

コンテナ停止

```sh
> docker-compose stop
```

コンテナ削除

```sh
> docker-compose down
```

## アクセス

コンテナ起動後に、以下のURLでアクセスできます  

- [http://localhost:8000/](http://localhost:8000/) Web
- [http://localhost:8880/](http://localhost:8880/) phpMyAdmin
- [http://localhost:8025/](http://localhost:8025/) MailHog

コンテナ内のシェルに移動する  

```sh
> cd THIS_REPOSITORY_DIR
> docker-compose up -d
> docker exec -it sample-laravel bash
$ pwd
/var/www/laravel
$ php artisan list
$ exit
```

- リポジトリルートが `/mnt` にmountされています。
- laravel フォルダが `/var/www/laravel` になっています。
- シェルの初期位置が `/var/www/laravel` になっています。

## UnitTestの実行

```sh
> cd THIS_REPOSITORY_DIR
> docker-compose up -d
> docker exec -it sample-laravel php artisan test
```

もしくは

```sh
> cd THIS_REPOSITORY_DIR
> docker-compose up -d
> docker exec -it sample-laravel bash
$ php artisan test
```

## .env ファイルの更新
docker用.envファイルにも機密事項が入っているため、1passwordでの管理になります。
.envファイル更新のアナウンスがあったときの作業です。

1password の "docker 用 .env ファイル" から .env をダウンロードします。
ダウンロードした .env を laravel/.env に上書きします。

.envファイルを更新した際には
```sh
> cd THIS_REPOSITORY_DIR
> docker exec -it sample-laravel /mnt/.docker/laravel/clrcache.sh
```
を実行します。

