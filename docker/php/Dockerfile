# Stage 1: Base
FROM php:8.3-fpm-alpine AS base

ARG UID=1000
ARG GID=1000

RUN apk add --no-cache \
    curl \
    git \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    mysql-client

RUN docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN addgroup -g ${GID} laravel \
 && adduser -D -u ${UID} -G laravel laravel

WORKDIR /var/www

# Stage 2: Development
FROM base AS development

USER laravel

EXPOSE 9000
CMD ["php-fpm"]

# Stage 3: Production
FROM base AS production

RUN apk add --no-cache nodejs npm

COPY --chown=laravel:laravel . .

RUN mkdir -p /var/www/vendor && chown -R laravel:laravel /var/www

RUN cp .env.example .env && \
    sed -i 's/APP_ENV=local/APP_ENV=production/' .env && \
    sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env && \
    sed -i 's/LOG_LEVEL=debug/LOG_LEVEL=error/' .env && \
    chown laravel:laravel .env

USER laravel

RUN composer install --no-dev --optimize-autoloader --no-scripts

RUN npm install && npm run build

RUN php artisan key:generate --force

USER root
COPY docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

USER laravel

EXPOSE 9000
CMD ["/entrypoint.sh"]
