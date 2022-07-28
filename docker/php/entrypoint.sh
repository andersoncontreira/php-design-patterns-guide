#!/bin/bash
# install the dependencies
/usr/local/bin/composer install

# generate documentation
# ./scripts/swagger.sh

# execute the migrations
# php artisan migrate

# run php-fpm
php-fpm
