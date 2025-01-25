#!/bin/sh

composer install --optimize-autoloader

chmod 777 /storage/logs
chmod 777 /storage/frameworks/sessions
chmod 777 /storage/frameworks/views

yarn install && yarn build

php-fpm