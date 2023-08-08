FROM php:8.0-fpm-buster AS base

#Env Path
ENV HOME "/root"
ENV PATH "$HOME/.composer/vendor/bin:/opt/mssql-tools/bin:${PATH}"
ENV PHP_ROOT '/var/www/'

#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --filename=composer --install-dir=/usr/local/bin && \
    php -r "unlink('composer-setup.php');"

#Basic Libaries
RUN apt-get update && apt-get install apt-transport-https wget gnupg -y

# Install Required Libs
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libssl-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    git \
    curl \
    zip \
    unzip \
    apt-utils  \
    locales  \
    zlib1g-dev  \
    libldap2-dev  \
    libicu-dev

#Pecl Install
RUN pecl update-channels && \
    docker-php-ext-install zip && \
    docker-php-ext-enable zip && \
    pecl install redis-5.3.5 && \
    docker-php-ext-enable redis && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap && \
    docker-php-ext-install opcache && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    docker-php-ext-install mbstring exif pcntl bcmath gd && \
    docker-php-ext-configure gd

#Set Working Directory
WORKDIR $PHP_ROOT

#Clean up the directory
RUN rm -rf $PHP_ROOT

#Create the directory
RUN mkdir -p $PHP_ROOT

#Copy Files
COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.conf

############ Testing ###########
FROM base as dev

#Install Xdebug
RUN pecl install xdebug-3.1.2 && docker-php-ext-enable xdebug

RUN curl -sS -o - https://dl-ssl.google.com/linux/linux_signing_key.pub  | apt-key add - &&\
             echo "deb [arch=amd64]  http://dl.google.com/linux/chrome/deb/  stable main" >> /etc/apt/sources.list.d/google-chrome.list &&\
             apt-get -y update &&\
             apt-get -y install google-chrome-stable

########## Production #########
FROM base as prod

COPY ../ ${PHP_ROOT}

RUN cp .env.example .env

COPY docker/php/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint

RUN chmod +x /usr/local/bin/docker-php-entrypoint

RUN composer install --optimize-autoloader --no-dev &&\
    chmod 777 -R storage &&\
    chmod 777 -R bootstrap/cache &&\
    php artisan key:generate
