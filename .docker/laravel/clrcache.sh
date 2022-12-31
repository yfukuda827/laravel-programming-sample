#!/bin/sh
# laravelキャッシュをクリアします

php artisan view:clear
php artisan cache:clear
# composer は artisan 実行ユーザとは別に実行します
## composer install
php artisan clear-compiled
php artisan optimize
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
