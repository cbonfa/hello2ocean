#!/bin/sh
set -e

echo "🚚 Deploying application"

echo "⬇️ Laravel down"

(php artisan down) || true

    echo "⬇️ Updating base code: master branch"
    
    git fetch origin master
    git reset --hard origin/master

    echo "📦 Installing composer dependencies"
    
    /opt/cpanel/composer/bin/composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

    echo "🗃️ Running migrations"

    php artisan migrate --force

    echo "🔄 Restarting queue"
    
    php artisan queue:restart

    echo "🧹 Recreating cache"
    
    php artisan optimize

    # echo "📦 Installing Npm dependencies"
    
    # npm ci

    # echo "🏗️ Compiling assets"
    
    # npm run production

    # echo "🔐 Applying permissions"
    
    # find /var/www/project -type f -exec chmod 644 {} \;
    # find /var/www/project -type d -exec chmod 755 {} \;
    # chown -R www-data:www-data /var/www/project
    # chgrp -R www-data /var/www/project/storage /var/www/project/bootstrap/cache
    # chmod -R ug+rwx /var/www/project/storage /var/www/project/bootstrap/cache

    # echo "🔄 Restarting Php"
    
    # echo "" | -S service php8.1-fpm reload
    
echo "⬆️ Rising Laravel"

php artisan up

echo "🎉 Deployed application"