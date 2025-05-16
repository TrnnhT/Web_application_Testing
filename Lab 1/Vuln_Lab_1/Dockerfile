FROM php:8.1-apache

WORKDIR /var/www/html/

# Copy all source files
COPY ./Source .

# Permissions setup
RUN chown -R www-data:www-data /var/www/html && \
    chmod 750 /var/www/html && \
    mkdir -p /var/www/html/uploads && \
    chmod 777 /var/www/html/uploads && \
    find . -type f -exec chmod 640 {} \; && \
    find . -type d -exec chmod 750 {} \;

# Install MySQL client and mysqli extension
RUN apt-get update && \
    apt-get install -y default-mysql-client && \
    docker-php-ext-install mysqli
