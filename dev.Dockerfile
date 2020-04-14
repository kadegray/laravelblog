FROM wyveo/nginx-php-fpm:php72

# set our application folder as an environment variable
ENV APP_HOME /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_NO_INTERACTION=1

RUN apt-get update
# RUN apt-get upgrade -y --allow-unauthenticated
RUN apt-get install -y php-xdebug

COPY default.conf /etc/nginx/conf.d/default.conf
COPY php.ini /usr/local/etc/php/conf.d/

RUN curl --silent --show-error https://getcomposer.org/installer | php

# php configuration
COPY ./php-xdebug.ini /etc/php/${PHP_VERSION}/fpm/conf.d/20-xdebug.ini
COPY ./php-xdebug.ini /etc/php/${PHP_VERSION}/cli/conf.d/20-xdebug.ini

WORKDIR $APP_HOME

# change ownership of our applications
RUN chown -R www-data:www-data $APP_HOME

EXPOSE 80