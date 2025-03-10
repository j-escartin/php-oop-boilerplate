#Use the official PHP  8.2 FPM image  with required extension
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libcurl4-openssl-dev \
    mariadb-client \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql mysqli curl dom \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

#  Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Set Permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
 