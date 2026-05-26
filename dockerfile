FROM php:8.2-apache

# Install PDO and MySQL extension
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite (optional but common)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

