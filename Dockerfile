FROM php:7.0-fpm

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer

RUN apt-get update \
    && apt-get install -y libicu-dev git zip libssl-dev \
    && docker-php-ext-install intl \
    && pecl install apcu-5.1.3 && echo extension=apcu.so > /usr/local/etc/php/conf.d/apcu.ini \
    && pecl install mongodb && echo extension=mongodb.so > /usr/local/etc/php/conf.d/mongo.ini

WORKDIR /var/www/skills-api
