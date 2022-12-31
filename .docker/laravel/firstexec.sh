#!/bin/sh

# 作業場所へ移動
cd `dirname $0`
SCR_DIR=`pwd`
if [ -d /var/www/html ];then
  cd /var/www/html
else
  cd ../../html
fi
WORK_HOST=`hostname`
WORK_DIR=`pwd`
echo "update start: host[${WORK_HOST}]: workdir[${WORK_DIR}]"

# 簡易時刻合わせ
echo "set the system time from the RTC..."
hwclock -s

# .envを作成
rm -f .env
cp .env.docker .env
ln -s .env.docker.testing .env.testing

# composerを実行
composer install

if [ "$1" != "--nodb" ];then
    # set MySQL Access settings
    echo '[client]' > ~/.my.cnf
    echo 'user=root' >> ~/.my.cnf
    echo 'password=root' >> ~/.my.cnf
    echo 'default-character-set=utf8mb4' >> ~/.my.cnf
    chmod 400 ~/.my.cnf

    # databaseを初期化
    echo "initialize(refresh) empty db: database..."
    mysql --batch --host=db -e 'DROP DATABASE IF EXISTS `database`;'
    mysql --batch --host=db -e 'CREATE DATABASE IF NOT EXISTS `database` CHARACTER SET utf8mb4;'
    mysql --batch --host=db -e 'GRANT ALL ON `database`.* TO '"docker@'%';"
    php artisan migrate:refresh

    # testerdbを初期化
    echo "initialize(refresh) empty db: testerdb..."
    mysql --batch --host=db -e 'DROP DATABASE IF EXISTS `testerdb`;'
    mysql --batch --host=db -e 'CREATE DATABASE IF NOT EXISTS `testerdb` CHARACTER SET utf8mb4;'
    mysql --batch --host=db -e 'GRANT ALL ON `testerdb`.* TO '"docker@'%';"

    # DBにデータを入れる
    echo "initialize database.* table..."
    php artisan db:seed
fi

# storageディレクトリに書込み権
find ./storage -type d -print0 | xargs --null chmod 777
find ./storage -type f -print0 | xargs --null chmod 666

# public/storage が存在しないなら作成する
cd public
if [ ! -e storage ];then ln -s ../storage/app/public storage ;fi
cd ..
