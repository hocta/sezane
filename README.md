# Boutique Test technique

## Documentation
Ceci est une boutique écrite en Symfony 6 pour un test technique

# Installation AUTO
Se placer à la racine du projet
````shell
./start.sh
````

(Si vous avez lancé ".start.sh", les commandes ci-dessous ne sont pas nécessaire)

# Installation Docker
Se placer à la racine du projet
````shell
docker-compose up --build -d --remove-orphans
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

# Database
php bin/console doctrine:schema:update --force

# Load Fixtures
php bin/console doctrine:fixtures:load

#génération doc API
composer swagger
````

## Phpmyadmin
http://localhost:7080/index.php

## Documentation API
http://localhost:9080/swagger/index.html

