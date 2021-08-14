FROM php:7.4-cli

COPY ./ /usr/src/musement-weather
WORKDIR /usr/src/musement-weather

RUN apt-get update && apt-get install -y \
        git \
        zip \
        unzip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

RUN composer install
RUN composer dumpautoload

CMD ["php", "-a"]


