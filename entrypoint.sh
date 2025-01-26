#!/bin/sh

chmod 777 storage/logs
chmod 777 storage/framework/sessions
chmod 777 storage/framework/views

composer install --no-dev --optimize-autoloader

php artisan key:generate
php artisan migrate --force

yarn install && yarn build

apache2-foreground