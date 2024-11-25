FROM richarvey/nginx-php-fpm:3.0.1

# Copiar los archivos del proyecto
COPY . .

# Configuración de imagen
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Configuración de Laravel
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Eliminar hirak/prestissimo
RUN composer global remove hirak/prestissimo || true

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Generar APP_KEY
RUN cp .env.example .env
RUN php artisan key:generate

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Permitir que Composer se ejecute como root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
