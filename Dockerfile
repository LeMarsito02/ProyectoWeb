# Imagen base con soporte para apt-get y extensiones de PHP
FROM php:8.2-fpm-bullseye

# Copiar el contenido del proyecto
COPY . /var/www/html

# Configuraciones para PHP-FPM
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Instalar dependencias necesarias y extensiones
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxslt-dev \
    libonig-dev \
    zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd xsl pdo_mysql

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remover hirak/prestissimo si existe
RUN composer global remove hirak/prestissimo || true

# Configurar permisos (opcional, si tienes problemas con permisos de archivos)
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 9000

# Comando inicial
CMD ["php-fpm"]
