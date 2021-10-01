ARG PHP_VERSION
FROM php:${PHP_VERSION}-apache as base

RUN apt-get update && apt-get install -y git libicu-dev libzip-dev unzip \
    && docker-php-ext-install intl pdo_mysql \
    && docker-php-ext-configure intl \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite
RUN a2enmod actions
RUN service apache2 restart

WORKDIR /var/www/html

FROM base as builder

RUN curl --fail --silent --show-error --location https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install --no-dev

FROM base as prod

COPY --from=builder /var/www/html/vendor /var/www/html/vendor
EXPOSE 80

FROM base as dev

RUN curl --fail --silent --show-error --location https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
