#!/bin/sh

composer install --no-dev --optimize-autoloader

npm install && npm run dev & php artisan serve --host=0.0.0.0