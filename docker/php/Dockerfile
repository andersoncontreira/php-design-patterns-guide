FROM php:7.4.0-fpm-alpine
MAINTAINER Anderson Contreira <anderson.contreira@gmail.com>
#-----------------------------------------------------------------------------------------------------------------------
# ENVS
#-----------------------------------------------------------------------------------------------------------------------
ENV PATH /app:$PATH
ENV DEBIAN_FRONTEND=noninteractive
#-----------------------------------------------------------------------------------------------------------------------
# WORKDIR
#-----------------------------------------------------------------------------------------------------------------------
WORKDIR /app
#-----------------------------------------------------------------------------------------------------------------------
# Dependencies
#-----------------------------------------------------------------------------------------------------------------------
# Update the alpine
RUN apk update && apk upgrade
# Install dependencies
RUN apk add --no-cache build-base \
    curl \
    git \
    htop \
    libpng-dev \
    libxml2-dev \
    memcached \
    openssl-dev \
    openssl \
    supervisor \
    tcpdump \
    unzip \
    vim \
    wget && \
    rm -rf /var/lib/apt/lists/*
# telnet
RUN apk add --no-cache busybox-extras
#    libicu-dev \
#    libcurl4-gnutls-dev \
#-----------------------------------------------------------------------------------------------------------------------
# PHP Extensions
#-----------------------------------------------------------------------------------------------------------------------
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \
    && apk add --no-cache --virtual .build-deps
# extensions
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd
RUN docker-php-ext-configure mysqli --with-mysqli=mysqlnd
RUN docker-php-ext-install \
    bcmath \
    gd \
    opcache \
    pcntl \
    pdo_mysql \
    soap

# Extensions by PECL
RUN pecl install apcu && docker-php-ext-enable apcu
# redis
RUN pecl install redis && docker-php-ext-enable redis
# xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

#-----------------------------------------------------------------------------------------------------------------------
# Composer
#-----------------------------------------------------------------------------------------------------------------------
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#-----------------------------------------------------------------------------------------------------------------------
# Files
#-----------------------------------------------------------------------------------------------------------------------
COPY composer.json composer.lock ./
COPY ./env/development.env /env/development.env
#-----------------------------------------------------------------------------------------------------------------------
# EXPOSE PORT - Expose default port at which the application will respond
#-----------------------------------------------------------------------------------------------------------------------
EXPOSE 9000
#-----------------------------------------------------------------------------------------------------------------------
# ENTRYPOINT
#-----------------------------------------------------------------------------------------------------------------------
# copy entrypoint file to boot the php app
COPY ./docker/php/entrypoint.sh /usr/local/bin/
# give the permissions
RUN chmod 775 /usr/local/bin/entrypoint.sh
# backwards compatibility
RUN ln -s /usr/local/bin/entrypoint.sh /
# cmd
CMD ["entrypoint.sh"]
