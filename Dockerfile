FROM php:8.4-cli

# Laravel 需要的最小擴充：pdo_mysql、zip、bcmath。
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libzip-dev default-mysql-client \
    && docker-php-ext-install pdo_mysql zip bcmath \
    && rm -rf /var/lib/apt/lists/*

# 從官方 composer image 直接拷貝 composer 執行檔。
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
