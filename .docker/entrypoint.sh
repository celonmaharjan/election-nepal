#!/bin/bash

# Exit on error
set -e

echo "🚀 Booting Election Portal..."

# Use $PORT provided by Render, or default to 80
export PORT=${PORT:-80}
sed -i "s/Listen 80/Listen 0.0.0.0:$PORT/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/g" /etc/apache2/sites-available/000-default.conf

# Cache configurations for speed
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations if DB is available
php artisan migrate --force || echo "⚠️ Database not ready or migration failed. Skipping."

# Start Apache
echo "🌍 App is live"
exec apache2-foreground
