# Use the official PHP 8.0.2 image
FROM php:8.2-fpm

# Install required extensions and dependencies
RUN docker-php-ext-install pdo pdo_mysql pcntl
#RUN docker-php-ext-install mbstring gd
RUN apt-get update && apt-get install -y libzip-dev zip unzip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the Laravel application files into the container
#COPY . .
COPY composer.json ./
#COPY composer.lock ./

# Install Laravel dependencies
# RUN composer install --no-interaction

# Install Node.js and npm

# RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
  RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
# RUN apt-get install -y nodejs
  RUN apt-get install nodejs -y

# Install Vue.js dependencies
# RUN npm install

# Expose port 9000 for PHP-FPM
#EXPOSE 8000

# CMD ["php-fpm"]

#CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
