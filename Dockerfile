FROM php:8.0-apache
COPY . /var/www/html/
COPY custom-apache.conf /etc/apache2/sites-available/000-default.conf
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80
