#!/bin/sh

composer update && composer install --optimize-autoloader

# chmod 777 storage/logs/laravel.log
# chmod 777 storage/framework/sessions
# chmod 777 storage/framework/views
# chmod 777 storage/framework/cache/data/*
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

rm -rf public/hot

yarn && yarn build

apache2-foreground
