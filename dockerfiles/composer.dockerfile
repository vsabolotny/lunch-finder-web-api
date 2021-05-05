FROM composer:latest

WORKDIR /var/www/html

ENTRYPOINT ["/bin/bash", "-c", "composer install --ignore-platform-reqs"]