FROM php:8.1-apache

WORKDIR /var/www/html/

# Copy all source files to web root
COPY ./Source .

# Create secret file outside the web root
RUN mkdir -p /secret && \
    echo "[2025-05-01 08:23:45] Login attempt: username=guest, password=guest123\n\
            [2025-05-01 09:05:12] Login attempt: username=john_doe, password=letmein\n\
            [2025-05-01 09:47:33] Login attempt: username=alice, password=hunter2\n\
            [2025-05-01 10:14:56] Login attempt: username=test, password=test\n\
            [2025-05-01 10:55:42] Login attempt: username=admin, password=123' OR 1=1#\n\
            [2025-05-01 11:03:01] Login attempt: username=demo, password=qwerty\n\
            [2025-05-01 11:44:20] Login attempt: username=frank, password=spring2025" > /secret/secret.txt && \
    chown www-data:www-data /secret/secret.txt && \
    chmod 644 /secret/secret.txt

# Setup permissions for web root
RUN chown -R www-data:www-data /var/www/html && \
    chmod 755 /var/www/html && \
    mkdir -p /var/www/html/uploads && \
    chmod 777 /var/www/html/uploads && \
    find . -type f -exec chmod 644 {} \; && \
    find . -type d -exec chmod 750 {} \;

COPY --chown=www-data:www-data ./Source /var/www/html/

# Install MySQL client and mysqli extension
RUN apt-get update && \
    apt-get install -y default-mysql-client && \
    docker-php-ext-install mysqli
