#!/bin/bash

# Exit on error
set -e

echo "🚀 Booting Election Portal..."

# Use $PORT provided by Render, or default to 80
export PORT=${PORT:-80}
# Tell Apache to explicitly bind to the Render port using both IPv4 and IPv6
echo "Listen $PORT" > /etc/apache2/ports.conf
sed -i "s/<VirtualHost.*/<VirtualHost \*:$PORT>/g" /etc/apache2/sites-available/000-default.conf

# Cache configurations for speed
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations if DB is available
php artisan migrate --force || echo "⚠️ Database not ready or migration failed. Skipping."

# Start Apache
echo "🌍 App is live"
exec apache2-foreground
