FROM php:8.2-apache

# 🧱 Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev npm \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# 🎼 Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 📁 Copia el proyecto
COPY . /var/www/html/
WORKDIR /var/www/html

# 🔥 Apache configuración
RUN a2enmod rewrite
COPY ./docker/vhost.conf /etc/apache2/sites-enabled/000-default.conf

# 🔧 Permisos iniciales
RUN mkdir -p storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 🎶 Instala dependencias Laravel
RUN composer install --no-dev --optimize-autoloader || exit 1

# 🎨 Vite build
RUN npm install && npm run build

# 🧹 Limpieza de caché defensiva
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

# 🔧 Regenerar y migrar
RUN php artisan config:cache || true
RUN php artisan migrate --force || true
RUN php artisan up

# 📎 Storage y logs
RUN php artisan storage:link || true
RUN touch storage/logs/laravel.log \
    && chmod -R 777 storage/logs

EXPOSE 80
