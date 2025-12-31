FROM php:8.2-cli

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application
COPY . .

# Install dependencies
RUN composer install --no-dev

# Expose port
EXPOSE 8000

# Run Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
