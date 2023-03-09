FROM php:8.1.0-fpm-alpine
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
# linux headers
RUN apk add --update linux-headers
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
# RUN pecl install xdebug && docker-php-ext-enable xdebug
# Install xdebug
RUN pecl install xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM_XDEBUG" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    # IP docker
    && echo "xdebug.client_host=172.17.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && docker-php-ext-enable xdebug

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

# chage the persions of the files in storage logs
# RUN chmod 775 storage/logs/*
# cmd
CMD ["entrypoint.sh"]
