FROM ubuntu:20.04

RUN apt-get update && \
    apt-get -y upgrade && \
    apt-get install -y curl gnupg ca-certificates apt-transport-https software-properties-common

# Install PHP 8.2
RUN add-apt-repository -y ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php8.2 php8.2-fpm php8.2-mysql php8.2-redis php8.2-mbstring php8.2-xml php8.2-zip php8.2-curl

# Install Redis
RUN apt-get install -y redis-server

# Install MySQL
RUN apt-get install -y mysql-server

# Install Nginx
RUN apt-get install -y nginx

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Copy PHP configuration
COPY php.ini /etc/php/8.2/fpm/php.ini

# Set working directory
WORKDIR /var/www/html

# Create Laravel log directory
RUN mkdir -p /var/www/html/storage/logs && chmod -R 777 /var/www/html/storage

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

COPY . /var/www/html

# Expose ports
EXPOSE 80

# Start Nginx and PHP-FPM
# CMD service php8.2-fpm start && service nginx start && tail -f /var/log/nginx/access.log
CMD service php8.2-fpm start && nginx -g "daemon off;"
