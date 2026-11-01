FROM php:8.5.12-apache-bookworm@sha256:5e4418695f9b13b75edefaff547125bf6be267e865931731bdd5946461505736

RUN a2enmod rewrite headers expires \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" exif gd intl mbstring mysqli zip \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY . .

RUN chown -R www-data:www-data wp-content

EXPOSE 80
