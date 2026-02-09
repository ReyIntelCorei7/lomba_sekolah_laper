#!/bin/bash

# Laravel Railway Startup Script
# This script runs migrations and starts the server

# Create storage link if not exists
php artisan storage:link --force 2>/dev/null || true

# Run migrations
php artisan migrate --force

# Start the Laravel development server on port 8080
# Using hardcoded port to avoid string/int type error
exec php artisan serve --host=0.0.0.0 --port=8080
