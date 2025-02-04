#!/bin/sh

# cloudflared access tcp --hostname morent-db.borenmon.dev --url 127.0.0.1:3308 &

git config --global --add safe.directory /var/www/html

yarn && yarn dev &

composer update && composer install

php artisan serve --host=0.0.0.0
