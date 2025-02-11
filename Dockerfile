FROM php:8.1-fpm
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev zip unzip curl
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
WORKDIR /var/www
COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
