FROM richarvey/nginx-php-fpm:3.0.1

# Copiar archivos del proyecto
COPY . .

# Variables de entorno
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxslt-dev \
    && docker-php-ext-install -j$(nproc) gd xsl

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Configuración de Laravel
RUN cp .env.example .env
RUN php artisan key:generate
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["/start.sh"]
