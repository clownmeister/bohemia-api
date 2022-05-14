FROM php:8.1-fpm-buster

USER root

RUN apt update && apt upgrade -y && apt-get install -y bash git zip unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl && \
    docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql && \
    pecl install xdebug

ARG DEV_UID
ARG DEV_GID
ENV DEV_UID=${DEV_UID}
ENV DEV_GID=${DEV_GID}

RUN addgroup --gid ${DEV_GID} dev
RUN adduser --uid ${DEV_UID} dev --gid ${DEV_GID}
