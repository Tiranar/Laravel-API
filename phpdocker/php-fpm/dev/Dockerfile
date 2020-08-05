FROM phpdockerio/php72-fpm:latest

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

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
    zlib1g-dev zip \
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

WORKDIR "/var/www"