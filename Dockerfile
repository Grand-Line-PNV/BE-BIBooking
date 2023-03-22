FROM ubuntu:20.04

RUN apt-get update && apt-get -y upgrade && apt-get install -y \
    curl \
    gnupg \
    ca-certificates \
    apt-transport-https \
    software-properties-common \
    nginx \
    php8.0 \
    php8.0-fpm \
    php8.0-mysql \
    php8.0-redis \
    php8.0-mbstring \
    php8.0-xml \
    php8.0-zip \
    php8.0-curl \
    mysql-client \
    redis-server \
    supervisor

# copy nginx.conf to container
COPY ./nginx.conf /etc/nginx/nginx.conf

# create laravel log directory
RUN mkdir /var/www/html/storage/logs && chmod -R 777 /var/www/html/storage

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
