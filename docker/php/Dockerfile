FROM php:8.3.12-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libonig-dev \
    libxml2-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    libpq-dev \
    zlib1g-dev \
    libzip-dev \
    libz-dev \
    supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip gettext intl

# Install Redis extension
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
ARG CURRENT_UID
RUN groupadd -g ${CURRENT_UID} backend \
    && useradd -u ${CURRENT_UID} -ms /bin/bash -g backend backend

# Copy existing application directory contents
COPY . /var/www

# Set ownership for copied files
COPY --chown=backend:backend . /var/www

# Change current user to 'backend'
USER backend

# Expose port 9000 and start php-fpm server
EXPOSE 9000
ENTRYPOINT ["sh", "-c", "php artisan queue:work --daemon & php artisan schedule:run && php-fpm"]
