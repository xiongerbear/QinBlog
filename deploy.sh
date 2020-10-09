#!/usr/bin/env bash
# Created by PhpStorm.
# User: xiongyoulong
# Date: 2020/9/22
# Time: 6:00 PM

cd /var/www/QinBlog/
git checkout master
git pull
cd /var/www/QinBlog/
php artisan config:cache
php artisan event:cache
php artisan route:cache
