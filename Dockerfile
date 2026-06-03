FROM php:8.2-apache

RUN a2enmod rewrite

COPY . /var/www/html/

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/*.conf

EXPOSE 80