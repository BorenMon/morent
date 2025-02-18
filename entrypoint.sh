#!/bin/sh

composer update && composer install --optimize-autoloader

chmod 777 storage/logs
chmod 777 storage/framework/sessions/*
chmod 777 storage/framework/views

rm -rf public/hot

yarn && yarn build

apache2-foreground
# & php artisan queue:work --daemon
