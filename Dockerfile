FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy existing application directory contents
COPY . /var/www/html

# Copy startup script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage
RUN chmod -R 755 /var/www/html/bootstrap/cache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache - FIXED SYNTAX
RUN echo "<Directory /var/www/html/public>" > /etc/apache2/conf-available/laravel.conf && \
    echo "    AllowOverride All" >> /etc/apache2/conf-available/laravel.conf && \
    echo "    Require all granted" >> /etc/apache2/conf-available/laravel.conf && \
    echo "</Directory>" >> /etc/apache2/conf-available/laravel.conf

RUN a2enconf laravel

# Expose port 80
EXPOSE 80

# Use startup script for Laravel initialization
CMD ["/usr/local/bin/docker-entrypoint.sh"]
