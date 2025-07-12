# Stage 1: Build assets con Node
FROM node:18 AS node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build

# Stage 2: Servidor PHP con Apache y Composer
FROM php:8.2-apache

# Instala dependencias necesarias, composer y extensiones PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    libzip-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Habilita mod_rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copia todo el código al contenedor
COPY . .

# Instala dependencias de PHP con Composer dentro del contenedor
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copia assets compilados del builder node
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Da permisos correctos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone puerto 80
EXPOSE 80

CMD ["apache2-foreground"]
