FROM php:8-fpm

RUN apt-get -qq update && apt-get -qq install -y \
    $PHPIZE_DEPS \
    git \
    bash \
    libonig-dev \
    libmcrypt-dev \
    libpq-dev \
    libwebp-dev \
    libpng-dev \
    libzip-dev \
    libjpeg-dev \
    libicu-dev \
    nano \
    openssl \
    sqlite3 \
    sudo \
    unzip \
    vim \
    wget \
    zip

RUN pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-configure gd \
    --enable-gd \
    --with-webp \
    --with-jpeg

RUN docker-php-ext-install \
    zip \
    pdo \
    pdo_pgsql \
    mbstring \
    tokenizer \
    bcmath \
    pcntl \
    intl \
    gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

RUN apt-get clean

RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/cache/*

WORKDIR /app
