#!/bin/sh

set -e

echo "Starting Laravel development environment..."

# Wait for database to be ready
if [ "$DB_CONNECTION" = "mysql" ]; then
    echo "Waiting for MySQL at $DB_HOST:$DB_PORT..."
    while ! nc -z "$DB_HOST" "$DB_PORT" 2>/dev/null; do
        sleep 1
    done
    echo "MySQL is ready!"
fi

# Install PHP dependencies if vendor doesn't exist
if [ ! -d "vendor" ] || [ ! -f "vendor/autoload.php" ]; then
    echo "Installing PHP dependencies..."
    composer install --optimize-autoloader --no-interaction
fi

# Install Node dependencies if node_modules doesn't exist
if [ ! -d "node_modules" ]; then
    echo "Installing Node dependencies..."
    npm install
fi

# Generate application key if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Create storage link if not exists
if [ ! -L public/storage ]; then
    echo "Creating storage link..."
    php artisan storage:link
fi

# Set permissions
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Start PHP-FPM in background
php-fpm -D

# Start Vite dev server in background (for HMR)
echo "Starting Vite dev server..."
npm run dev -- --host 0.0.0.0 --port 5173 &

# Start Nginx in foreground
echo "Starting Nginx..."
exec nginx -g "daemon off;"
