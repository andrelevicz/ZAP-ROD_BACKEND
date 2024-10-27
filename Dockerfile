# Use the official PHP image as a base
FROM php:8.1-fpm

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the application code into the container
COPY . .

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && docker-php-ext-install pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies with Composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions for storage and bootstrap/cache directories
RUN chown -R ${UID}:${GID} /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Define the user and group IDs as build arguments
ARG UID
ARG GID

# Create a new group and user with the provided IDs
RUN groupadd -g 1000 appgroup && useradd -m -u 1000 -g appgroup appuser

# Switch to the non-root user
USER appuser

# Expose the application port
EXPOSE 9000

# Start the PHP FastCGI Process Manager
CMD ["php-fpm"]
