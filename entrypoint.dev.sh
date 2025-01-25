#!/bin/sh

composer install --no-dev --optimize-autoloader

yarn install && yarn dev & php artisan serve --host=0.0.0.0