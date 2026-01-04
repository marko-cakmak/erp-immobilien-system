FROM php:8.3-fpm-alpine

ARG UID=1000
ARG GID=1000

# System dependencies
RUN apk add --no-cache \
    curl \
    git \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    mysql-client

# PHP extensions for Laravel
RUN docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create application user matching host UID/GID
RUN addgroup -g ${GID} laravel \
 && adduser -D -u ${UID} -G laravel laravel

WORKDIR /var/www

USER laravel

EXPOSE 9000
CMD ["php-fpm"]
