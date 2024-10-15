# Menggunakan image PHP sebagai base
FROM mysql:latest as mysql

# Mengatur environment variables untuk MySQL
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=nadi
ENV MYSQL_USER=root
ENV MYSQL_PASSWORD=root

# Expose MySQL port
EXPOSE 3306

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

# Menyiapkan MySQL untuk auto-start
# RUN service mysql start

# Mengatur working directory
WORKDIR /var/www

# Menyalin composer.lock dan composer.json
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Menginstal Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Menyalin semua file aplikasi ke dalam image
COPY . .

# Menginstal dependensi Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

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
EXPOSE 8080

# Menjalankan PHP-FPM
# CMD ["php-fpm"]

# Menjalankan MySQL dan PHP-FPM
CMD ["sh", "-c", "mysqld & php-fpm"]
