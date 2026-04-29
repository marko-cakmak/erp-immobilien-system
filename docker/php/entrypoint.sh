#!/bin/sh
set -e

echo "Waiting for MySQL to be ready..."
until php -r "
try {
    new PDO('mysql:host=mysql;dbname=immobilien_erp', 'laravel', 'secret');
    exit(0);
} catch (Exception \$e) {
    exit(1);
}
" 2>/dev/null; do
    echo "MySQL not ready yet, waiting 2 seconds..."
    sleep 2
done

echo "MySQL is ready!"

echo "Running migrations..."
php artisan migrate --force

echo "Checking if seeding is needed..."
USER_COUNT=$(php artisan tinker --execute="echo \App\Models\User::count();")
if [ "$USER_COUNT" = "0" ]; then
    echo "Running seeders..."
    php artisan db:seed --force
    echo "Seeders executed!"
else
    echo "Database already seeded, skipping..."
fi

echo "Clearing cache..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting PHP-FPM..."
exec php-fpm
