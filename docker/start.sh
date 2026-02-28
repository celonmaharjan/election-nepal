#!/bin/bash

# Exit on error
set -e

echo "🚀 Starting Production Setup..."

# Optimized Laravel Caching
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run Migrations (Force for production)
# Note: If database is not ready, this might fail initially
php artisan migrate --force || echo "⚠️ Migration failed, database might not be ready yet."

# Start PHP-FPM in background
php-fpm -D

# Start Nginx in foreground
echo "🌍 Server is live on port 80"
nginx -g "daemon off;"
