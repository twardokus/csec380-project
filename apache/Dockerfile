FROM php:7.2.1-apache-stretch
COPY ./php.ini /usr/local/etc/php/conf.d/
RUN docker-php-ext-install mysqli
RUN service apache2 restart

COPY php.ini /usr/local/etc/php/php.ini
