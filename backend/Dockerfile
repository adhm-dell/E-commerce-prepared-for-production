FROM php:8.3.11-fpm

# Use HTTPS for Debian mirrors (fix blocked port 80 issues)
RUN [ -f /etc/apt/sources.list ] && sed -i 's|http://deb.debian.org|https://deb.debian.org|g' /etc/apt/sources.list || true

# Install system dependencies
RUN apt-get update || apt-get update --allow-releaseinfo-change \
    && apt-get install -y --fix-missing \
    libzip-dev \
    libpng-dev \
    libicu-dev \
    postgresql-client \
    libpq-dev \
    git \
    unzip \
    zlib1g-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js & npm (manual for reliability)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install PHP extensions (intl required by Filament)
RUN docker-php-ext-install intl pdo pdo_pgsql pgsql zip bcmath gd \
    && pecl install redis \
    && docker-php-ext-enable redis

# Set working directory
WORKDIR /usr/share/nginx/html/

# Copy project files
COPY . ./

# Optimize Laravel
RUN rm -rf vendor/ \
    && sed 's_@php artisan package:discover_/bin/true_;' -i composer.json \
    && composer install --ignore-platform-req=php --no-dev --optimize-autoloader \
    && composer clear-cache \
    && php artisan package:discover --ansi \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache

# Set environment
ENV APP_ENV=production
ENV APP_DEBUG=false

# Copy PHP-FPM entrypoint script
COPY ./scripts/php-fpm-entrypoint /usr/local/bin/php-entrypoint
RUN chmod +x /usr/local/bin/php-entrypoint

# Entrypoint and CMD
ENTRYPOINT ["/usr/local/bin/php-entrypoint"]
CMD ["php-fpm"]
