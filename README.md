# Lunch finder
Welcome to the project https://www.find-a-lunch.de/, which is also called `Lunch Finder`. 

Today this is running as prototype, with static data in it. But some day it will be in usage.

Then you will be able to `find active foodtrucks` on your phone in a awesome app.

---
# Development
For development you will need docker. Install it.

Clone this project and run
```
$ docker-compose up -d
```

Because I don't know how to fix it, you'll need to run it twice. Sorry.

## Applications
Frontend `localhost`
Backend `localhost/admin`
Adminer `localhost:8080`

---
# References
The compose specification https://github.com/compose-spec/compose-spec/blob/master/spec.md

---
# Some useful commands

## Stop and cleanup

Docker compose down with deletion of images, volumes and containers
```
$ docker-compose down -v --rmi all --remove-orphans
```

Or step by step
```
$ docker container prune 
$ docker volume prune
$ docker image prune -a
```

Cleanup created files
```
$ rm -rf app/node_modules && rm -rf app/vendor && rm -rf mysql && mkdir mysql
```

Or just use the docker-compose-down.sh
```
$ chmod +x commands/docker-compose-down.sh
$ ./docker-compose-down.sh
```