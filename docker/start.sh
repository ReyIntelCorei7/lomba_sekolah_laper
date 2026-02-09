#!/bin/bash

# Laravel Railway Startup Script
# Using PHP built-in server directly (bypasses artisan serve issues)

# Create storage link if not exists
php artisan storage:link --force 2>/dev/null || true

# Run migrations
php artisan migrate --force

# Cache config for production
php artisan config:clear
php artisan cache:clear

# Start PHP built-in server directly (NOT artisan serve)
# This avoids the ServeCommand.php string/int type error
cd /app
exec php -S 0.0.0.0:8080 -t public server.php
