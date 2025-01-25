#!/bin/sh

composer install --optimize-autoloader

yarn install && yarn build

php-fpm