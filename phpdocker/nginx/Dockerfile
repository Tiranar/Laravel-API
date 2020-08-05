FROM nginx

# Copy custom configuration file for localhost nginx fpm
ADD ./phpdocker/nginx/fastcgi.conf /etc/nginx/fastcgi_params
ADD ./phpdocker/nginx/deploy.default.conf /etc/nginx/nginx.conf

ADD public /var/www/public

WORKDIR /var/www

EXPOSE 80