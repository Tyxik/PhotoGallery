# Použij PHP 8.3.12 jako základní obraz
FROM php:8.3.12-fpm

# Nastavení pracovního adresáře
WORKDIR /var/www/html

# Instalace systémových závislostí
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

# Instalace Composeru
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Zkopírování aplikace do kontejneru
COPY . .

# Instalace PHP balíčků přes Composer
RUN composer install --no-dev --optimize-autoloader

# Nastavení oprávnění pro Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Exponování portu
EXPOSE 8000

# Start aplikace
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]