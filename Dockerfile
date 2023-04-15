FROM php:7.3-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN echo "output_buffering = 4096" > /usr/local/etc/php/conf.d/output-buffering.ini
EXPOSE 80

