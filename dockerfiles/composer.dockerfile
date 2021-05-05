FROM composer:latest

WORKDIR /var/www/html

COPY app .

RUN composer install --ignore-platform-reqs

#RUN bin/console doctrine:database:drop --force --if-exists

#RUN bin/console doctrine:database:create --if-not-exists

#RUN bin/console doctrine:migrations:migrate -q

#RUN bin/console doctrine:fixtures:load -q

#RUN bin/phpunit

#RUN php-fpm

#ENTRYPOINT [ "composer", "--ignore-platform-reqs"]

ENTRYPOINT ["/bin/bash", "-c", "(bin/console doctrine:database:drop --force --if-exists && bin/console doctrine:database:create --if-not-exists && bin/console doctrine:migrations:migrate -q && bin/console doctrine:fixtures:load -q) ; bin/phpunit ; php-fpm"]