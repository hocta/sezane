#!/bin/bash

docker-compose up --build -d --remove-orphans

if [ ! -f .env.local ]; then
  cp .env.local.dist .env.local
fi

containerName=$(docker ps -aqf "name=php-8.1")
docker exec -it $containerName sh -c "composer install && \
  yarn install && \
  php bin/console doctrine:schema:update --force && \
  php bin/console doctrine:fixtures:load -n && \
  composer swagger"