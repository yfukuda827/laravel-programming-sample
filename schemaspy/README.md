# SchemaSpy で ER 図を作成する

## 事前準備

```sh
> cd THIS_REPOSITORY_DIR
> cp schemaspy/schemaspy.properties.sample schemaspy/schemaspy.properties
> docker-compose up -d --build  
```

SchemaSpy 設定ファイルで、ローカルのデータベースへ接続設定を記入します。  
`schemaspy/schemaspy.properties`  

## 実行コマンド

以下のコマンドを実行することで、 データベース情報が解析されて ER 図などが作成されます  

```sh
> cd THIS_REPOSITORY_DIR
> docker run --network="host" -v "$PWD/schemaspy/docs:/output" -v "$PWD/schemaspy/drivers:/drivers" -v "$PWD/schemaspy/schemaspy.properties:/schemaspy.properties" schemaspy/schemaspy:latest -all  
```

`schemaspy/docs/index.html` をダブルクリックしてアクセスすると、データベースの情報を確認できます。  
