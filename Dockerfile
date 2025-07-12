# Stage 1: Build assets con Node
FROM node:18 AS node-builder

WORKDIR /app

# Copia archivos de dependencias front
COPY package*.json ./

# Instala dependencias Node
RUN npm install

# Copia el resto del código front y Laravel (si tienes todo junto)
COPY . .

# Compila los assets para producción
RUN npm run build

# Stage 2: Servidor PHP con Apache
FROM php:8.2-apache

# Instala extensiones y dependencias necesarias para Laravel
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

# Habilita mod_rewrite de apache para Laravel
RUN a2enmod rewrite

# Copia el código PHP/Laravel al contenedor
COPY . /var/www/html

# Copia los assets compilados de Node a la carpeta pública
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Da permisos correctos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone puerto 80
EXPOSE 80

# Comando para arrancar apache en primer plano
CMD ["apache2-foreground"]
