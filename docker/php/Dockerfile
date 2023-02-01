FROM php:8.2-fpm

RUN apt-get clean all
RUN apt-get update -y
RUN apt-get install -y git libzip-dev zlib1g-dev zip p7zip

# COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /bin/composer

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install zip
CMD php-fpm