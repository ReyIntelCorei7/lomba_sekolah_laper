# Use official PHP 8.3 image
FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    dos2unix

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev for production)
RUN composer install --optimize-autoloader --no-dev --no-scripts --no-interaction

# Copy package files
COPY package.json package-lock.json ./

# Install Node dependencies
RUN npm ci

# Copy application files
COPY . .

# Create storage directories and set permissions
RUN mkdir -p storage/framework/cache/data \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chmod -R 775 storage \
    && chmod -R 775 bootstrap/cache

# Run composer scripts after all files are copied
RUN composer dump-autoload --optimize

# Build frontend assets
RUN npm run build

# Convert start script to Unix line endings and make executable
RUN dos2unix /app/docker/start.sh 2>/dev/null || sed -i 's/\r$//' /app/docker/start.sh
RUN chmod +x /app/docker/start.sh

# Expose port
EXPOSE 8080

# Set environment
ENV PORT=8080

# Start using PHP built-in server (NOT artisan serve)
CMD ["bash", "-c", "php artisan migrate --force && php artisan storage:link --force 2>/dev/null; php -S 0.0.0.0:8080 -t public server.php"]
