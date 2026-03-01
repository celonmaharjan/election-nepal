#!/bin/bash

# Exit on error
set -e

echo "🚀 Booting Election Portal..."

# Fix: Ensure only one MPM is loaded (prefork is required for mod_php)
a2dismod mpm_event mpm_worker 2>/dev/null || true
a2enmod mpm_prefork 2>/dev/null || true

# Use $PORT from Render (defaults to 10000), fallback to 80 for local dev
export PORT=${PORT:-80}

# Force Apache to listen on 0.0.0.0:$PORT so Render's port scanner can detect it
echo "Listen 0.0.0.0:${PORT}" > /etc/apache2/ports.conf

# Update vhost to match the port
sed -i "s/:80>/:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Cache configurations for speed
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations if DB is available
php artisan migrate --force || echo "⚠️ Database not ready or migration failed. Skipping."

# Start Apache
echo "🌍 App is live"
exec apache2-foreground
