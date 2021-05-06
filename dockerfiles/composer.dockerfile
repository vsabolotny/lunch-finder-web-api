FROM composer:latest

WORKDIR /var/www/html

# CMD ["/bin/bash", "-c", "sleep 30s"]

ENTRYPOINT ["/bin/bash", "-c", "composer install --ignore-platform-reqs"]