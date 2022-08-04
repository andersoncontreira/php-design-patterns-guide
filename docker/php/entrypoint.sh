#!/bin/bash
# install the dependencies
/usr/local/bin/composer install

# execute the migrations
# php artisan migrate
composer run migrate

# openapi/swagger docs generation
composer run docs

# run php-fpm
php-fpm
