FROM php:8.1-fpm

MAINTAINER Lazar Milosavljevic <lazar.milosavljevic@quantox.com>

RUN apt-get update

RUN apt-get install -y \
        git \
        wget \
        libicu-dev \
        nano \
        zip \
        libzip-dev;

# PHP Extensions
RUN docker-php-ext-install bcmath \
		                   intl \
		                   pdo_mysql;