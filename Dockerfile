FROM wyveo/nginx-php-fpm:php72

COPY laravel /var/www/html
ENV APP_HOME /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_NO_INTERACTION=1

RUN apt-get update
# RUN apt-get upgrade -y --allow-unauthenticated

COPY default.conf /etc/nginx/conf.d/default.conf
COPY php.ini /usr/local/etc/php/conf.d/

RUN curl --silent --show-error https://getcomposer.org/installer | php

WORKDIR $APP_HOME

RUN composer install
RUN apt-get install -y npm
RUN npm i -g npm@latest

# change ownership of our applications
RUN chown -R www-data:www-data $APP_HOME

EXPOSE 80