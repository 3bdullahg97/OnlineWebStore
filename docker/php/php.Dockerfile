FROM php:7.1-fpm

RUN apt-get update && apt-get install -y zlib1g-dev \
    libmcrypt-dev && docker-php-ext-install pdo_mysql mcrypt zip 

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ARG USER_ID

RUN usermod -u ${USER_ID} www-data && groupmod -g ${USER_ID} www-data

WORKDIR /var/www
 
RUN chown -R www-data:www-data ./