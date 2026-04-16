FROM composer:latest AS builder
COPY . /app
RUN composer install --no-dev

FROM php:8.4-apache
COPY --from=builder /app /var/www/html