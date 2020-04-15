#!/bin/bash

LARAVEL_LOG=/var/www/html/storage/logs/laravel.log
if test -f "$LARAVEL_LOG"; then
    chown -R www-data:www-data "$LARAVEL_LOG"
    chmod 777 "$LARAVEL_LOG"
fi

chown -R www-data:www-data /var/www/html/storage
chmod -R 777 /var/www/html/storage

cd /var/www/html
php artisan migrate --force

/start.sh