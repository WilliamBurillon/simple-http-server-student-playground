# Stage 1: Composer
FROM composer:2 as composer

WORKDIR /app

COPY ./ /app

RUN composer install \
    --optimize-autoloader \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Stage 2: PHP and Nginx
FROM php:8.2-fpm

# Install Nginx and supervisord from Debian repository
RUN apt-get update && apt-get install -y nginx supervisor && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY --from=composer /app /app

RUN docker-php-ext-install pdo_mysql

COPY . .

RUN chown -R www-data:www-data \
    /app/storage \
    /app/bootstrap/cache

COPY ./nginx.conf /etc/nginx/conf.d/default.conf


RUN  php artisan key:generate
# Supervisor configuration
RUN echo "[supervisord]" > /etc/supervisor/conf.d/supervisord.conf \
    && echo "nodaemon=true" >> /etc/supervisor/conf.d/supervisord.conf \
    && echo "" >> /etc/supervisor/conf.d/supervisord.conf \
    && echo "[program:php-fpm]" >> /etc/supervisor/conf.d/supervisord.conf \
    && echo "command=php-fpm" >> /etc/supervisor/conf.d/supervisord.conf \
    && echo "" >> /etc/supervisor/conf.d/supervisord.conf \
    && echo "[program:nginx]" >> /etc/supervisor/conf.d/supervisord.conf \
    && echo "command=nginx -g 'daemon off;'" >> /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
