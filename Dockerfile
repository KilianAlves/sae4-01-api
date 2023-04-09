FROM php:8.1-apache as DEV

 #echo "ServerName localhost" >> /etc/apache2/apache2.conf \
RUN apt-get update \
    &&  apt-get install -y npm \
    &&  apt-get install -y --no-install-recommends \
        locales apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev unzip \
\
    &&  echo "en_US.UTF-8 UTF-8" > /etc/locale.gen  \
    &&  echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen \
    &&  locale-gen \
\
    &&  docker-php-ext-configure \
            intl \
    &&  docker-php-ext-install \
            pdo pdo_mysql opcache intl zip calendar dom mbstring gd xsl \
\
    &&  pecl install apcu && docker-php-ext-enable apcu


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && curl -sS https://get.symfony.com/cli/installer | bash


RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

COPY . /var/www

WORKDIR /var/www

RUN symfony server:ca:install

RUN composer install \
    --no-interaction \
    --prefer-dist

EXPOSE 8000

ENTRYPOINT ["symfony" ,"serve"]