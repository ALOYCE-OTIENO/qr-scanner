#!/bin/bash
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan serve --host=0.0.0.0 --port=$PORT
