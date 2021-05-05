FROM php:cli

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

ENTRYPOINT ["/bin/bash", "-c", "bin/console doctrine:database:drop --force --if-exists && bin/console doctrine:database:create --if-not-exists && bin/console doctrine:migrations:migrate -q && bin/console doctrine:fixtures:load -q"]