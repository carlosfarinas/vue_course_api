FROM php:8.1.18-fpm
LABEL authors="CF"

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

#Install Composer
RUN php -r "copy('https://urldefense.com/v3/__https://getcomposer.org/installer__;!!Hh9bRStGYTk4!O4R8vtNYDc87TQm91kOOL_jrhcTFrKGceb5cc9nfqZXAGhe3gneFnRE4XCm0o1yfYn2ZEFdo6Bw8W3vJ5kwp$ ', 'composer-setup.php');" && \
    php composer-setup.php --filename=composer --install-dir=/usr/local/bin && \
    php -r "unlink('composer-setup.php');"


# Install Required Libs
RUN apt-get update && ACCEPT_EULA=Y apt-get install libzip-dev unzip apt-utils locales zlib1g-dev libldap2-dev libpng-dev libicu-dev -y

#Pecl Install
RUN pecl update-channels && \
    docker-php-ext-install zip && \
    docker-php-ext-enable zip && \
    pecl install redis-5.3.5 && \
    docker-php-ext-enable redis && \
    docker-php-ext-install pdo pdo_mysql \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap && \
    docker-php-ext-install opcache && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl \
    docker-php-ext-install mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/











