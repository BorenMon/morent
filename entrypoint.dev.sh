#!/bin/sh

chmod 700 /root/.ssh/config
chmod 700 /root/.ssh/id_rsa.pub

composer install --no-dev --optimize-autoloader

yarn install 

cloudflared access tcp --hostname morent-admin-db.borenmon.dev --url 127.0.0.1:3308 & yarn dev & php artisan serve --host=0.0.0.0