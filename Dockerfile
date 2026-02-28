# --- Stage 1: Build Assets ---
FROM node:20-alpine AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: Production Server ---
FROM php:8.4-fpm-alpine

# Install system dependencies
RUN apk add --no-cache 
    nginx 
    wget 
    icu-dev 
    libpq-dev 
    libpng-dev 
    libzip-dev 
    zip 
    unzip 
    git 
    bash

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql gd zip intl bcmath

# Configure Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Set up working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .
COPY --from=assets-builder /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy startup script
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]
