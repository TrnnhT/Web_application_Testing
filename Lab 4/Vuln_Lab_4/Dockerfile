FROM php:8.1-apache

WORKDIR /var/www/html/

# Copy all source files to web root
COPY ./Source .

# Setup permissions for web root
RUN chown -R www-data:www-data /var/www/html && \
    chmod 755 /var/www/html && \
    mkdir -p /var/www/html/uploads && \
    chmod 777 /var/www/html/uploads && \
    find . -type f -exec chmod 644 {} \; && \
    find . -type d -exec chmod 750 {} \;

RUN echo '{lab4_flag_captured}' >> /etc/passwd

# Install MySQL client and mysqli extension
RUN apt-get update && \
    apt-get install -y default-mysql-client && \
    docker-php-ext-install mysqli
