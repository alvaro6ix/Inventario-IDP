FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev npm \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el código
COPY . /var/www/html/

# Setea el directorio y permisos
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Habilita mod_rewrite para Laravel
RUN a2enmod rewrite
COPY ./docker/vhost.conf /etc/apache2/sites-enabled/000-default.conf

# Corre Composer
RUN composer install --no-dev --optimize-autoloader

# Corre npm para el frontend
RUN npm install && npm run build

# Cachea config
RUN php artisan config:cache

EXPOSE 80
