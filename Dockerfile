FROM php:8.0-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql sockets
RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
RUN composer install

# Install any necessary dependencies
RUN apk update && \
    apk add --no-cache \
        postgresql-dev \
        git \
        zip \
        libzip-dev \
        libpng-dev \
        libxml2-dev \
        libmcrypt-dev \
        freetype-dev \
        libjpeg-turbo-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql zip gd xmlrpc mbstring json mcrypt && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
