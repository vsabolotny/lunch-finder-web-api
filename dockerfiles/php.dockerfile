FROM php:fpm

WORKDIR /var/www/html

COPY app .

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug

RUN docker-php-ext-enable xdebug

RUN pecl install apcu

RUN apt-get update && apt-get install -y libzip-dev

RUN docker-php-ext-install zip

RUN docker-php-ext-enable apcu

# RUN chown -R www-data:www-data /var/www/html