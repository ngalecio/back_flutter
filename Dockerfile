# Usa la imagen base de PHP-FPM compatible con Laravel 12
FROM php:8.2-fpm

# Instala dependencias del sistema y extensiones PHP necesarias para Laravel y Composer
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Instala Composer globalmente
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define el directorio de trabajo (donde se copia el código)
WORKDIR /var/www

# Copia el código de la aplicación al contenedor.
# Usamos 'COPY --from' para no incluir el código en la capa de construcción
# Esto se manejará mejor con Volúmenes en docker-compose.yml
# Simplemente mantenemos el WORKDIR

# Instalar dependencias de Laravel (ejecutar en la capa final para caching)
# Opcionalmente, puedes mover esto a un script de inicio si prefieres
# RUN composer install --no-dev --optimize-autoloader --no-interaction
# COPIA todo el código de tu repositorio (donde está storage y bootstrap/cache)
COPY . /var/www
# Asegurar que el usuario 'www-data' tenga permisos sobre las carpetas de almacenamiento
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# El comando de inicio por defecto de php:8.2-fpm es el proceso FPM
CMD ["php-fpm"]