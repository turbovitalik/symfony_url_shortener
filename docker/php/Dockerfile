FROM php:7.1-fpm

# Install recommended extensions for Symfony
RUN apt-get update && apt-get install -y \
        libicu-dev \
    && docker-php-ext-install \
        intl \
        opcache \
        pdo \
        pdo_mysql \
    && docker-php-ext-enable \
        intl \
        opcache

RUN apt-get install -y --no-install-recommends git zip unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Permission fix
RUN usermod -u 1000 www-data
