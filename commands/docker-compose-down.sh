#!/bin/bash

echo "-- starting docker-compose down"

docker-compose down -v --rmi all --remove-orphans

echo "-- cleaning up the files"

rm -rf app/node_modules && rm -rf app/vendor && rm -rf mysql && mkdir mysql

echo "-- checking for orphans"

echo "-- container"
docker ps -a

echo "-- images"
docker images

echo "-- volumes"
docker volume ls

echo "-- networks (will not be deleted)"
docker network ls

echo "-- docker-down is done"