#!/bin/bash

curl -sS https://getcomposer.org/installer | php
php composer.phar install
php composer.phar dumpautoload

php -a

