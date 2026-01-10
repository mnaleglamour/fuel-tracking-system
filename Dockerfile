FROM php:8.2-apache

ENV COMPOSER_MEMORY_LIMIT=-1

# Install system + PHP dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip \
    libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-install \
        pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean

# Enable Apache rewrite
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy only composer files
COPY composer.json composer.lock ./

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies WITHOUT scripts
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --prefer-dist \
    --ignore-platform-reqs

# Copy full Laravel project
COPY . .

# ❌ DO NOT run composer dump-autoload here
# ❌ DO NOT run artisan commands in Docker build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Apache config
COPY apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
