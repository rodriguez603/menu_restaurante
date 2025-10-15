# Imagen base oficial de PHP con Composer
FROM php:8.2-cli

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    unzip \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia todo el código del proyecto
WORKDIR /app
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Genera APP_KEY y ejecuta migraciones + seeders
RUN php -r "file_exists('.env') || copy('.env.example', '.env');" \
 && php artisan key:generate \
 && touch database/database.sqlite \
 && php artisan migrate --force --seed \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# Expone el puerto 8000 (Render usa la variable $PORT)
EXPOSE 8000

# Comando de inicio del servidor Laravel
CMD php artisan serve --host 0.0.0.0 --port $PORT
