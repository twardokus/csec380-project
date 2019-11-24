FROM php:7.2.1-apache-stretch
COPY ./php.ini /usr/local/etc/php/conf.d/
RUN service apache2 restart
COPY php.ini /usr/local/etc/php/php.ini
RUN docker-php-ext-install mysqli
RUN usermod -u 1000 www-data
RUN chown -R www-data /var/www/html
RUN chown -R www-data /tmp
RUN chmod 777 -R /

