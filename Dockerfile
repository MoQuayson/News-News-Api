FROM php:8.1-fpm-alpine

# Set the working directory to /app
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

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
