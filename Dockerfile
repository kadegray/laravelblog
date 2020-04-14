FROM wyveo/nginx-php-fpm:php72

COPY laravel /var/www/html
ENV APP_HOME /var/www/html

RUN apt-get update
# RUN apt-get upgrade -y --allow-unauthenticated

COPY default.conf /etc/nginx/conf.d/default.conf
COPY php.ini /usr/local/etc/php/conf.d/

WORKDIR $APP_HOME

# change ownership of our applications
RUN chown -R www-data:www-data $APP_HOME

EXPOSE 80