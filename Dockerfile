FROM php:7.4-cli

ARG COMPOSER_AUTH

RUN apt-get update && apt-get install -y librdkafka-dev \
    git \
    libzip-dev

RUN docker-php-ext-install zip

RUN cd /tmp
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN pecl install rdkafka-3.1.3 && docker-php-ext-enable rdkafka


WORKDIR /var/www/poc-enqueue
#COPY ./docker/etc/php.ini /usr/local/etc/php/php.ini