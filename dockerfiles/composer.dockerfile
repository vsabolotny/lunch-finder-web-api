FROM composer:latest

WORKDIR /var/www/html

ENTRYPOINT ["/bin/bash", "-c", "sleep 30s && composer install --ignore-platform-reqs && sleep 30s"]