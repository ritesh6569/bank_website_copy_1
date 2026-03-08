# PHP 8.2 with Apache + bundled MySQL
# Cache-bust: 2026-03-08-v8
FROM php:8.2-apache

# Install PHP extensions + MySQL server + supervisor
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    default-mysql-server \
    default-mysql-client \
    supervisor \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd pdo pdo_mysql mysqli \
  && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite headers deflate expires

# Set working directory
WORKDIR /var/www/html

# Copy composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy composer files first for layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev, optimise autoloader)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy application files
COPY . .

# Copy Apache configs
COPY apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY apache-ports.conf /etc/apache2/ports.conf

# Suppress ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Create writable directories and set permissions
RUN mkdir -p uploads/gallery uploads/downloads logs \
  && chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html \
  && chmod -R 775 /var/www/html/uploads \
  && chmod -R 775 /var/www/html/logs

# Supervisor config to run both MySQL and Apache
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

# Copy startup script and make executable
COPY docker-start.sh /docker-start.sh
RUN chmod +x /docker-start.sh

CMD ["/docker-start.sh"]
