FROM dunglas/frankenphp

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN rm -f .env bootstrap/cache/*.php

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

ENV FRANKENPHP_CONFIG="worker ./public/index.php"
ENV SERVER_NAME=":${PORT:-8080}"

CMD ["sh", "-c", "php artisan config:cache && php artisan migrate --force && frankenphp run"]