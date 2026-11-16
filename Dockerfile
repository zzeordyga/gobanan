# ---------- base: PHP 8.4 FPM + system deps ----------
FROM php:8.4-fpm-alpine AS base

RUN apk add --no-cache \
        nginx \
        libpng-dev libjpeg-turbo-dev freetype-dev \
        libzip-dev oniguruma-dev \
        sqlite-dev \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_sqlite zip bcmath \
        && apk add --no-cache sqlite-libs \
        && rm -rf /var/cache/apk/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
ENV COMPOSER_ALLOW_XDEBUG=0

# ---------- vendor ----------
FROM base AS vendor
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# ---------- frontend build ----------
FROM node:26-alpine AS frontend
WORKDIR /app
COPY package.json ./
RUN npm install --no-audit --no-fund
COPY . .
RUN npx vite build

# ---------- app ----------
FROM base AS app
COPY . .
COPY --from=vendor /var/www/html/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

# Re-resolve package discovery for the installed (no-dev) deps
RUN composer dump-autoload --no-dev --optimize \
    && php artisan package:discover --ansi \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# nginx site
COPY <<'NGINX' /etc/nginx/http.d/default.conf
server {
    listen 80;
    server_name _;
    root /var/www/html/public;
    index index.php;

    client_max_body_size 12m;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    location /build/ { try_files $uri =404; }
    location = /favicon.ico { access_log off; log_not_found off; }
}
NGINX

COPY <<'ENTRYPOINT' /usr/local/bin/entrypoint
#!/bin/sh
set -e
php artisan migrate --force --graceful || true
php-fpm -D
exec nginx -g 'daemon off;'
ENTRYPOINT
RUN chmod +x /usr/local/bin/entrypoint

EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint"]