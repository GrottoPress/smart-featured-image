ARG PHP_VERSION=8.2
ARG WORDPRESS_VERSION=6.6

FROM prooph/composer:${PHP_VERSION} AS vendor

WORKDIR /tmp

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer update \
        --no-autoloader \
        --no-dev \
        --no-interaction \
        --no-scripts \
        --prefer-dist

RUN composer dump-autoload \
        --no-dev \
        --no-interaction \
        --no-scripts \
        --optimize

FROM wordpress:${WORDPRESS_VERSION}-php${PHP_VERSION}-apache

ARG PLUGIN_NAME=smart-featured-image

ENV PLUGIN_NAME=${PLUGIN_NAME}
ENV WORDPRESS_DIR=/var/www/html
ENV PLUGIN_DIR=${WORDPRESS_DIR}/wp-content/plugins/${PLUGIN_NAME}

COPY --chown=www-data . /usr/src/${PLUGIN_NAME}/
COPY --chown=www-data --from=vendor /tmp/vendor/ /usr/src/${PLUGIN_NAME}/vendor/
COPY docker/docker-entrypoint.sh /tmp/

RUN cat /usr/local/bin/docker-entrypoint.sh | \
        sed '/^\s*exec "$@"/d' > \
        /usr/local/bin/docker-main-entrypoint.sh; \
    cat /tmp/docker-entrypoint.sh >> \
        /usr/local/bin/docker-main-entrypoint.sh; \
    chmod +x /usr/local/bin/docker-main-entrypoint.sh

ENTRYPOINT ["docker-main-entrypoint.sh"]

CMD ["apache2-foreground"]
