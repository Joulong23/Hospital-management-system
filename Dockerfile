FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    zip unzip git libzip-dev

RUN docker-php-ext-install pdo pdo_mysql mysqli zip

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader

# Laravel permissions
RUN mkdir -p storage/logs
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Apache document root
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/*.conf

EXPOSE 80