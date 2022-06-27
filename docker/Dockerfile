FROM php:8.1.1-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libonig-dev\
    libxslt1-dev \
    libzip-dev \
    zip \
    unzip \
    build-essential \
    libaio1 \
    librabbitmq-dev \
    && apt-get upgrade -y  && apt-get clean

RUN docker-php-ext-install \
    bcmath \
    gd \
    intl \
    mbstring \
    opcache \
    pdo_mysql \
    mysqli \
    xsl \
    zip \
    sockets \
    soap

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal.test" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo 'date.timezone = "Europe/Paris"\n' > /usr/local/etc/php/conf.d/timezone.ini

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && mkdir /var/www/.composer \
    && chown www-data:www-data /var/www/.composer

RUN curl https://phar.phpunit.de/phpunit-7.phar -L -o phpunit.phar \
    && chmod +x phpunit.phar \
    && mv phpunit.phar /usr/local/bin/phpunit

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g yarn \
    && mkdir /var/www/.yarn \
    && mkdir /var/www/.cache \
    && touch /var/www/.yarnrc \
    && chown www-data:www-data /var/www/.yarn \
    && chown www-data:www-data /var/www/.yarnrc \
    && chown www-data:www-data /var/www/.cache

WORKDIR /var/www
