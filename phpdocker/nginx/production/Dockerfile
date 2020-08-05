FROM nginx

# Copy custom configuration file for localhost nginx fpm
ADD ./phpdocker/nginx/production/fastcgi.conf /etc/nginx/fastcgi_params
ADD ./phpdocker/nginx/production/deploy.production.conf /etc/nginx/nginx.conf

ADD public /var/www/public

WORKDIR /var/www

EXPOSE 80