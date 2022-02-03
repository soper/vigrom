FROM yiisoftware/yii2-php:7.4-fpm

# Установка основных модулей PHP
RUN apt update && apt install -y \
        libmcrypt-dev \
        mcrypt \
        libxpm-dev \
        libvpx-dev

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions pgsql