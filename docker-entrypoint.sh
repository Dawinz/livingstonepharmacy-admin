#!/bin/bash

# Exit on any error
set -e

echo "Starting Laravel application..."

# Generate application key if not exists
if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env
fi

# Generate app key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Clear and cache config
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
echo "Setting permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Start Apache
echo "Starting Apache..."
apache2-foreground
