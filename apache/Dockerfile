FROM php:7.2.1-apache-stretch
COPY ./php.ini /usr/local/etc/php/conf.d/
RUN usermod -u 1000 www-data
RUN service apache2 restart
COPY php.ini /usr/local/etc/php/php.ini
RUN chown -R www-data /var/www/html
RUN docker-php-ext-install mysqli
