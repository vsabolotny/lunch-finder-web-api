FROM node:latest

WORKDIR /var/www/html

ENTRYPOINT ["/bin/bash", "-c", "sleep 30s && yarn install && yarn watch && sleep 30s"]