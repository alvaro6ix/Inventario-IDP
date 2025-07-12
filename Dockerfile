FROM php:8.2-apache

# Instalar dependencias necesarias y extensiones PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Habilitar mod_rewrite (necesario para Laravel)
RUN a2enmod rewrite

# Copiar configuración personalizada de Apache para servir desde /public
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2dissite 000-default.conf && a2ensite 000-default.conf

# Copiar el proyecto Laravel al contenedor
COPY . /var/www/html/

# Establecer el directorio de trabajo
WORKDIR /var/www/html/

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Laravel
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Permisos para las carpetas necesarias
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80
EXPOSE 80

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]
