### HowTo Use
##### Web Frontend
http://127.0.0.1/

##### Web Backend
http://127.0.0.1/admin

##### MySQL
mysql -h127.0.0.1 -P3307 -udocker -pdocker foodtruck

##### Adminer
http://127.0.0.1:8080/

### HowTo Develop

#### Install Docker
Download from https://hub.docker.com/editions/community/docker-ce-desktop-mac/
or direct link: https://desktop.docker.com/mac/stable/Docker.dmg

#### Start Docker
just open the Docker UI

#### Start Docker Container
`docker-compose up -d`

#### "Cleanup" Docker Container
`docker-compose down`

`docker volume rm foodtruck_mysqldata`

and then follow the instructions in "Start Docker Container"

### Execute UnitTests
`bin/phpunit`

UnitTests are executed automatically at each start of docker container

### Deployment...

#####...to production
`bin/console deploy prod`

#####...to staging
`bin/console deploy staging`
