#!/bin/bash

echo "Instalando dependencias..."
composer install

php artisan key:generate
php artisan migrate

chmod -R 777 storage/logs
chmod -R 777 bootstrap/cache

echo "Finalizado..."