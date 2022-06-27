# Boutique Test technique

## Documentation
Ceci est une boutique écrite en Symfony 6 pour un test technique

# Installation Docker
Se place à la racine du projet
````shell
docker-compose build
docker-compose up -d
````

Se connecter en BASH sur le Docker, identifier le container "php-8.1" avec la commande "docker ps"
````shell

#Lister les dockers
docker ps

#connexion au Docker
docker exec -it [ID container] bash

#Env
cp .env.local.dist .env.local

#puis lancer :
composer install
yarn install

#génération doc API
composer swagger
````

## Phpmyadmin
http://localhost:7080/index.php

## Documentation API
http://localhost:9080/swagger/index.html

