FROM composer:2 AS dependencies

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

FROM wordpress:7.1.3-php8.5-apache@sha256:89e44e84974773a97b5ca5fa21b95377d372956fc9d7d1ad363e9fe062d5fe56

ENV WORDPRESS_CONFIG_EXTRA="define('DISALLOW_FILE_MODS', true); define('AUTOMATIC_UPDATER_DISABLED', true);"

# Every plugin is restored at the locked version instead of inherited from the
# upstream image or committed as third-party source code.
RUN rm -rf /usr/src/wordpress/wp-content/plugins/*

COPY --from=dependencies --chown=www-data:www-data \
    /app/wp-content/plugins/ \
    /usr/src/wordpress/wp-content/plugins/
COPY --chown=www-data:www-data \
    wp-content/themes/preciosagarrido/ \
    /usr/src/wordpress/wp-content/themes/preciosagarrido/
COPY --chown=www-data:www-data .htaccess /usr/src/wordpress/.htaccess
COPY docker/php.ini /usr/local/etc/php/conf.d/preciosa.ini

EXPOSE 80
