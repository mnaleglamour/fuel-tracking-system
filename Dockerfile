FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    zip \
    unzip \
    nginx \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --prefer-dist

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Create nginx config
RUN mkdir -p /etc/nginx/sites-available && \
    echo 'server { \
        listen 8080; \
        server_name _; \
        root /var/www/html/public; \
        index index.php; \
        location / { \
            try_files $uri $uri/ /index.php?$query_string; \
        } \
        location ~ \.php$ { \
            fastcgi_pass 127.0.0.1:9000; \
            fastcgi_index index.php; \
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
            include fastcgi_params; \
        } \
    }' > /etc/nginx/sites-available/default

# Expose port
EXPOSE 8080

# Start both PHP-FPM and nginx
CMD ["sh", "-c", "php-fpm -D && nginx -g \"daemon off;\""]

