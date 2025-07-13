FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev npm \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Instala Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el proyecto al contenedor
COPY . /var/www/html/

# Define directorio de trabajo y permisos
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Activa mod_rewrite para Laravel
RUN a2enmod rewrite
COPY ./docker/vhost.conf /etc/apache2/sites-enabled/000-default.conf

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Compila frontend con Vite
RUN npm install && npm run build

# Limpia cachés posibles de configuración, rutas y vistas
RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear
RUN php artisan cache:clear

# Regenera caché optimizada y corre migraciones
RUN php artisan config:cache
RUN php artisan migrate --force

# Enlaza storage y ajusta permisos
RUN php artisan storage:link
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Asegura que Laravel pueda escribir logs
RUN touch storage/logs/laravel.log
RUN chmod -R 777 storage/logs

EXPOSE 80
