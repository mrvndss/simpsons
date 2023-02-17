FROM php:8.1-cli

ARG user=lumen

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y libpq-dev  \
    libzip-dev \
    zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u 1000 -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Change to newly created user
USER $user

# Start the PHP built-in web server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]