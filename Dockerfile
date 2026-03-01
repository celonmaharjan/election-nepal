# Stage 1: Composer dependencies
FROM composer:2 as vendor
WORKDIR /app
COPY database/ database/
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install --ignore-platform-reqs --no-interaction --no-plugins --no-scripts --prefer-dist

# Stage 2: Node.js assets
FROM node:20-alpine as node_assets
WORKDIR /app
COPY package.json package.json
COPY package-lock.json package-lock.json
RUN npm install
COPY . .
RUN npm run build

# Stage 3: Final image
FROM php:8.4-apache

# Install the php-extension-installer helper
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install system dependencies and PHP extensions using the faster helper
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    && chmod +x /usr/local/bin/install-php-extensions \
    && install-php-extensions gd pdo_pgsql intl bcmath opcache

# Apache VirtualHost Configuration
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Configure mod_rewrite
RUN a2enmod rewrite

# Copy application code and built assets
WORKDIR /var/www/html
COPY --from=vendor /app/vendor/ vendor/
COPY --from=node_assets /app/public/build/ public/build/
COPY . .

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy entrypoint script
COPY .docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port 80
EXPOSE 80

# Use the entrypoint script to boot Laravel
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
