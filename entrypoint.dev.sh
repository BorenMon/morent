#!/bin/sh

composer install

cloudflared access tcp --hostname morent-admin-db.borenmon.dev --url 127.0.0.1:3308 &

php artisan key:generate
php artisan migrate

yarn install && yarn dev &

php artisan serve --host=0.0.0.0