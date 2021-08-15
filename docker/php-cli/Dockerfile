FROM php:7.4-cli

WORKDIR /usr/src/musement-weather

COPY . .

RUN apt-get update && apt-get install -y \
        git \
        zip \
        unzip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --version=1.10.17 \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

ENTRYPOINT ["sh", "./docker/php-cli/entrypoint.sh"]


