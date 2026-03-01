#!/bin/bash

# Exit on error
set -e

echo "🚀 Booting Election Portal..."

# Force Apache to listen on IPv4 (0.0.0.0) so Render's port scanner can detect it
echo "Listen 0.0.0.0:80" > /etc/apache2/ports.conf

# Cache configurations for speed
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations if DB is available
php artisan migrate --force || echo "⚠️ Database not ready or migration failed. Skipping."

# Start Apache
echo "🌍 App is live"
exec apache2-foreground
