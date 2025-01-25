FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g yarn

# Set the working directory
COPY . /var/www/html
WORKDIR /var/www/html

# Copy and install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy and install Yarn dependencies
RUN yarn install && yarn build

# Change PHP-FPM to listen on port 9002
RUN sed -i 's/listen = 9000/listen = 9002/' /usr/local/etc/php-fpm.d/www.conf

# Expose the new PHP-FPM port
EXPOSE 9002
