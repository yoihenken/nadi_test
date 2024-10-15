# Menggunakan image PHP sebagai base
FROM php:8.0-fpm

# Menginstal ekstensi yang diperlukan
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql zip

# Mengatur working directory
WORKDIR /var/www

# Menyalin composer.lock dan composer.json
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# COPY composer.lock composer.json ./

# Menginstal Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Menyalin semua file aplikasi ke dalam image
COPY . .

# Menginstal dependensi Laravel
# RUN composer install --no-autoloader --no-scripts
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Menyalin semua file aplikasi ke dalam image || default
# COPY . .

# Menjalankan composer autoload
RUN composer dump-autoload

# Mengatur permission untuk storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Mengatur environment
ENV APP_ENV=local
ENV APP_DEBUG=true
ENV APP_KEY=base64:eHEid2/5znqIvdknF/GG2yAuzjjKRBDIa4I+T7rsUng=
ENV DB_CONNECTION=mysql
ENV DB_HOST=localhost
ENV DB_PORT=3306
ENV DB_DATABASE=nadi
ENV DB_USERNAME=root
ENV DB_PASSWORD=root

# Menjalankan perintah untuk migrasi dan seeding database
# RUN php artisan migrate --force && php artisan db:seed --force

# Expose the port the app runs on
EXPOSE 8000

# Menjalankan PHP-FPM
CMD ["php-fpm"]
