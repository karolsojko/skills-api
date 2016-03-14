FROM php:7.0-fpm

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer

ADD . /var/www/skills-api
ADD ./docker/php/php.ini /usr/local/etc/php/php.ini
ADD ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /var/www/skills-api/var/cache /var/www/skills-api/var/logs

RUN apt-get update \
    && apt-get install -y libicu-dev git zip libssl-dev \
    && docker-php-ext-install intl \
    && pecl install apcu-5.1.3 && echo extension=apcu.so > /usr/local/etc/php/conf.d/apcu.ini \
    && pecl install mongodb && echo extension=mongodb.so > /usr/local/etc/php/conf.d/mongo.ini

WORKDIR /var/www/skills-api
