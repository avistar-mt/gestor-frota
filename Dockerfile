FROM php:8.3-fpm

# set your user name, ex: user=airton
ARG user=airton
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

# Copy custom configurations PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Copy PHP-FPM configuration
COPY docker/php-fpm/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

# Remove conflicting files and ensure only www.conf is present
RUN find /usr/local/etc/php-fpm.d/ -type f -name "*.conf" ! -name "www.conf" -delete

# Create PHP-FPM log directory and set permissions
RUN mkdir -p /var/log/php-fpm && \
    chown -R $user:www-data /var/log/php-fpm && \
    chmod -R 775 /var/log/php-fpm

# Copy application files
COPY . /var/www

# Adjust permissions for storage, bootstrap/cache, and public directories
RUN mkdir -p /var/www/public/images && \
    chown -R $user:$user /var/www/public/images && \
    chmod -R 775 /var/www/public/images && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/public

# Debug: List PHP-FPM config files
RUN ls -l /usr/local/etc/php-fpm.d/

# Test PHP-FPM configuration before starting
RUN php-fpm -t

# Start PHP-FPM in foreground
CMD ["php-fpm", "-F"]