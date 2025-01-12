# Используем официальный образ PHP с Apache
FROM php:8.2-apache

# Устанавливаем необходимые расширения PHP
RUN docker-php-ext-install pdo pdo_mysql

# Копируем файлы приложения в контейнер
COPY ./app /var/www/html

# Установка прав доступа к директории
RUN chown -R www-data:www-data /var/www/html

# Открываем порт для Apache
EXPOSE 80
