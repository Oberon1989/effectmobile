#!/bin/bash

if [ ! -f ".env" ]; then
    echo "Creating .env file..."
    cp .env.example .env
    
    sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env
    sed -i 's/# DB_HOST=127.0.0.1/DB_HOST=db/' .env
    sed -i 's/# DB_PORT=3306/DB_PORT=3306/' .env
    sed -i 's/# DB_DATABASE=laravel/DB_DATABASE=laravel/' .env
    sed -i 's/# DB_USERNAME=root/DB_USERNAME=root/' .env
    sed -i 's/# DB_PASSWORD=/DB_PASSWORD=root/' .env
fi

if [ ! -d "vendor" ]; then
    echo "Installing composer dependencies..."
    composer install --no-interaction --prefer-dist
fi

if ! grep -q "APP_KEY=base64" .env || [ -z "$(grep APP_KEY .env | cut -d '=' -f2)" ]; then
    echo "Generating app key..."
    php artisan key:generate
fi

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "Waiting for database..."
php -r "
    \$host = 'db';
    \$port = 3306;
    while (true) {
        try {
            if (@fsockopen(\$host, \$port, \$errno, \$errstr, 2)) {
                fwrite(STDOUT, 'Database is ready!' . PHP_EOL);
                exit(0);
            }
        } catch (Exception \$e) {}
        fwrite(STDOUT, 'Database is not ready, retry...' . PHP_EOL);
        sleep(2);
    }
"

echo "Running migrations..."
php artisan migrate:fresh --seed --force

echo "Starting PHP-FPM..."
exec php-fpm
