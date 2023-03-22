FROM php:8.2-fpm

# Install required packages
RUN apt-get update && \
    apt-get install -y \
        curl \
        libzip-dev \
        libonig-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libssl-dev \
        libmcrypt-dev \
        libicu-dev \
        libxml2-dev \
        git \
        unzip \
        zip \
        supervisor \
        && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd intl xml

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set recommended PHP.ini settings
COPY php/local.ini /usr/local/etc/php/conf.d/local.ini

WORKDIR /var/www/html

CMD ["php-fpm"]

EXPOSE 9000
