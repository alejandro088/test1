# Dockerfile for Laravel
FROM php:8.0-alpine

RUN apk add --no-cache \
    curl \
    git \
    make \
    php \
    php-cli \
    php-curl \
    php-mbstring \
    php-pdo \
    php-xml \
    php-zip \
    zlib

# install php-mysqli php-pdo

RUN docker-php-ext-install mysqli pdo pdo_mysql


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# add composer to PATH
ENV PATH /usr/local/bin:$PATH

WORKDIR /var/www/html

COPY . .

COPY .env.example .env

RUN composer install


EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0"]


