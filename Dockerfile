FROM php:8.2-apache

# 🧱 Instala extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libpng-dev libonig-dev libxml2-dev npm \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# 🎼 Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 📁 Copia el código al contenedor
COPY . /var/www/html/

# 🔧 Setea el directorio de trabajo y permisos
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

# 🔥 Activa mod_rewrite para Laravel
RUN a2enmod rewrite
COPY ./docker/vhost.conf /etc/apache2/sites-enabled/000-default.conf

# 🎶 Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# 🎨 Compila frontend con Vite
RUN npm install && npm run build

# 🧹 Limpia caché vieja antes de regenerarla
RUN php artisan config:clear
RUN php artisan config:cache

# 🧠 Corre migraciones
RUN php artisan migrate --force

# 📎 Enlaza storage y da permisos finales
RUN php artisan storage:link
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
