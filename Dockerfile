FROM php:8.2-apache

# Instala dependencias necesarias y la extensión gd
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Habilita mod_rewrite de Apache (necesario para Laravel)
RUN a2enmod rewrite

# Copia el código fuente al contenedor
COPY . /var/www/html/

# Establece el directorio de trabajo
WORKDIR /var/www/html/

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala dependencias de PHP con Composer
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Da permisos a storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["apache2-foreground"]
