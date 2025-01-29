FROM php:8.2-apache

# Встановлення необхідних PHP-розширень
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Копіювання всіх файлів у корінь веб-сервера
COPY . /var/www/html

# Налаштування прав доступу
RUN chown -R www-data:www-data /var/www/html
