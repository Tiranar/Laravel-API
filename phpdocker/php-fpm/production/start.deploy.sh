#!/bin/bash

# starts deployed containers in production behind supervisor. Responsible for running composer install
# and attempting to migrate the database if on beta.

cd /var/www

#grab the torus staging secrets and write them to the laravel .env file.
#torus export --org=example-api --project=core  -e production > /var/www/.env
# manifold export -p example-api-core-prod > /var/www/.env

su - www-data

echo "installing composer packages"
composer install --no-interaction --prefer-dist --optimize-autoloader
echo "packages installed"

#attempt to migrate -- disable this for now while we get everything else working.
# if [[ "$MIGRATE_ON_START" == "true" ]] ; then
	echo "Migrate the Database"
	php artisan migrate --force
# else
# 	echo "migration skipped"
# fi

su

# yarn install --frozen-lockfile --no-cache --production && yarn run production
# echo "yarn finished"

#write the last updated date to the .env file.
echo "" >> /var/www/.env
echo "LAST_UPDATED=\"`date -u`\"" >> /var/www/.env

#Start PHP!
echo "Starting PHP"
service php7.2-fpm start

echo "Clear Config Cache"
# php artisan config:cache

# Clear caches
php artisan cache:clear

# Clear expired password reset tokens
php artisan auth:clear-resets

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear and cache config
php artisan config:clear
php artisan config:cache

php artisan storage:link



su - www-data

# echo "Install NPM Packages from lock file"
# npm install

# echo "Run NPM Production"
# npm run prod

chown -R www-data:www-data /var/www \
    && find /var/www -type f -exec chmod 664 {} \; \
    && find /var/www -type d -exec chmod 775 {} \; \
    && chown -R www-data:www-data /start.sh \
    && chmod ug+rwx /start.sh \
    && chgrp -R www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R ug+rwx /var/www/storage /var/www/bootstrap/cache

test -f /var/www/public/js/app.js && echo "$FILE exist"

# su

#start supervisor
exec /usr/bin/supervisord -n -c /etc/supervisord.conf

su - www-data
