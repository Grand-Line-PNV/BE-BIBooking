# Base image
FROM ubuntu:latest

# Update package lists and install necessary packages
RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    ca-certificates \
    apt-transport-https \
    software-properties-common \
    nginx \
    php8.2 \
    php8.2-fpm \
    php8.2-mysql \
    php8.2-redis \
    php8.2-mbstring \
    php8.2-xml \
    php8.2-curl \
    mysql-server \
    redis-server \
    supervisor

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set up Laravel app
WORKDIR /var/www/html
COPY . .

# Install dependencies
RUN composer install --no-dev --no-interaction --no-progress

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose ports
EXPOSE 80
EXPOSE 3306
EXPOSE 6379

# Copy the supervisor configuration file
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
