#!/bin/sh

composer install --optimize-autoloader

chmod 777 storage/logs
chmod 777 storage/framework/sessions/*
chmod 777 storage/framework/views

yarn install && yarn build

apache2-foreground