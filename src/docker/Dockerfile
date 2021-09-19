ARG PHP_VERSION
FROM webdevops/php-nginx:${PHP_VERSION}-alpine as builder

COPY ./uploads.ini /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www/html

FROM builder as dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
