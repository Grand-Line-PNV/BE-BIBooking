FROM ubuntu:20.04

RUN apt-get update && apt-get -y upgrade && apt-get install -y \
    curl \
    gnupg \
    ca-certificates \
    apt-transport-https \
    software-properties-common \
    nginx \
    php7.4 \
    php7.4-fpm \
    php7.4-mysql \
    php7.4-redis \
    php7.4-mbstring \
    php7.4-xml \
    php7.4-zip \
    php7.4-curl \
    mysql-client \
    redis \
    supervisor

# copy nginx.conf to container
COPY ./nginx.conf /etc/nginx/nginx.conf

# create laravel log directory
RUN mkdir /var/www/html/storage/logs && chmod -R 777 /var/www/html/storage

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
