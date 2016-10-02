#!/usr/bin/env bash
git pull

chown -R apache:apache ./php

cd ./php
composer dump-autoload

php artisan view:clear

php artisan route:cache
php artisan clear-compiled
php artisan optimize --force

cd ../