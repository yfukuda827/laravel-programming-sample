# https://qiita.com/A-Kira/items/9a03d7b230741ed7b1de
# https://qiita.com/aseanchild1400/items/d3580366054fee3d2703

FROM php:8.0-apache
COPY ./php.ini /usr/local/etc/php/
COPY ./apache-docker-site.conf /etc/apache2/sites-enabled/000-default.conf

RUN apt-get update \
  && apt-get install -y zlib1g-dev \
  && apt-get install -y libzip-dev \
  && apt-get install -y libpq-dev mariadb-client unzip \
  && docker-php-ext-install zip pdo_mysql mysqli \
  && docker-php-ext-enable mysqli \
  && apt-get install -y nodejs npm \
  && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev\
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

WORKDIR /var/www/html

RUN composer global require "laravel/installer"

