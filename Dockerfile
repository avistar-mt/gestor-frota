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

# Opção 1: Configuração simplificada em um único arquivo
RUN echo '[global]\nerror_log = /var/log/php-fpm/error.log\nlog_level = debug\ndaemonize = no\n\n[www]\nuser = airton\ngroup = www-data\nlisten = 0.0.0.0:9000\npm = dynamic\npm.max_children = 5\npm.start_servers = 2\npm.min_spare_servers = 1\npm.max_spare_servers = 3' > /usr/local/etc/php-fpm.conf

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

# Test PHP-FPM configuration before starting
RUN php-fpm -t

# Start PHP-FPM in foreground
CMD ["php-fpm", "-F", "--fpm-config", "/usr/local/etc/php-fpm.conf"]