# Stage 1: Build assets con Node
FROM node:18 AS node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Servidor PHP con Apache
FROM php:8.2-apache

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
    && docker-php-ext-install gd pdo_mysql zip

RUN a2enmod rewrite

# Instalar composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copiar archivos PHP/Laravel
COPY . .

# Instalar dependencias PHP con composer
RUN composer install --no-dev --optimize-autoloader

# Copiar los assets compilados de Node
COPY --from=node-builder /app/public/build /var/www/html/public/build

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
