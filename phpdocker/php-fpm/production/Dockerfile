FROM phpdockerio/php72-fpm:latest

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive
ARG ENV_BUCKET

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    wget curl supervisor \
    libcurl3-openssl-dev \
    build-essential \
    php-memcached php7.2-mysql php7.2-pgsql php-redis php-xdebug \
    php7.2-bz2 php7.2-gd php-igbinary php-imagick php-ssh2 php-yaml \
    php7.2-gmp \
    libmcrypt-dev \
    libreadline-dev \
    zlib1g-dev zip cron \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

#do a composer install
RUN EXPECTED_COMPOSER_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig) && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '${EXPECTED_COMPOSER_SIGNATURE}') { echo 'Composer.phar Installer verified'; } else { echo 'Composer.phar Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');" && \
    composer global require "laravel/envoy" && \
    composer global require "laravel/installer"

# install node
RUN mkdir /home/node ;\
    cd /home/node ;\
    curl -sL https://deb.nodesource.com/setup_12.x | bash ;\
    apt-get install -y nodejs ;\
    node -v ;\
    npm -v

ENV PATH="/root/.composer/vendor/bin:${PATH}"

### PRODUCTION DEPLOYMENT PARTS

#setup a user and then own files properly for that user.
#Setup custom gids and uids for volume mapping / permissions
RUN groupadd -g 1001 manager
RUN useradd -ms /bin/bash manager -u 1001 -g 1001
RUN usermod -a -G www-data manager
# RUN usermod -a -G root manager

#copy key files into the container
COPY ./phpdocker/php-fpm/php-config/php-production.ini /etc/php/7.2/fpm/conf.d/php.ini
COPY ./artisan /var/www/artisan
COPY ./server.php /var/www/server.php
COPY ./webpack.mix.js /var/www/webpack.mix.js

# add babelrc vuex dependency
# COPY ./.babelrc /var/www/.babelrc

# add individual subdirs
ADD ./app /var/www/app
ADD ./bootstrap /var/www/bootstrap
ADD ./config /var/www/config
ADD ./database /var/www/database
ADD ./public /var/www/public
ADD ./resources /var/www/resources
ADD ./routes /var/www/routes

# make storage directory
RUN mkdir /var/www/storage
RUN mkdir /var/www/storage/logs
RUN mkdir /var/www/storage/files
RUN mkdir /var/www/storage/framework
RUN mkdir /var/www/storage/framework/sessions
RUN mkdir /var/www/storage/framework/views
RUN mkdir /var/www/storage/framework/cache
RUN mkdir /var/www/storage/files/reports

#Create Folder for PHP to run
# RUN mkdir /var/run/php

#make node modules dir
RUN mkdir /var/www/node_modules

# create logfile with proper app writing permissions
RUN touch /var/www/storage/logs/laravel.log && chown root:www-data /var/www/storage/logs/laravel.log && chmod g+w /var/www/storage/logs/laravel.log

# add the startup script.
ADD ./phpdocker/php-fpm/start.deploy.sh /start.sh

# Add conf file for running nginx and php fpm using supervisor
ADD ./phpdocker/php-fpm/supervisor.deploy.conf /etc/supervisord.conf

# we add the composer lock file and json here so if they change we won't cache
# the install. Otherwise we skip over the install.
COPY ./composer.lock /var/www/composer.lock
COPY ./composer.json /var/www/composer.json

#same for yarn as with composer.
COPY ./package.json /var/www/package.json
# COPY ./yarn.lock /var/www/yarn.lock

#### CRON ####
# Copy hello-cron file to the cron.d directory
COPY ./phpdocker/base-cron /etc/cron.d/base-cron

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/base-cron

# Apply cron job
RUN crontab /etc/cron.d/base-cron

# Create the log file to be able to run tail
RUN touch /var/log/cron.log


RUN chown -R www-data:www-data /var/www \
    && find /var/www -type f -exec chmod 664 {} \; \
    && find /var/www -type d -exec chmod 775 {} \; \
    && chown -R www-data:www-data /start.sh \
    && chmod ug+rwx /start.sh \
    && chgrp -R www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R ug+rwx /var/www/storage /var/www/bootstrap/cache

RUN chown -R www-data /var/www/bootstrap \
    && chown -R www-data /var/www/storage

RUN chmod -R 775 /var/www/storage
RUN chmod -R 775 /var/www/storage/logs

RUN mkdir -p /var/run/php


USER root
WORKDIR /var/www
RUN whoami

# expose relevant ports
EXPOSE 80 443

#run the startup script
CMD ["/start.sh"]
