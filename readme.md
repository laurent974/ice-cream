# Documentation

## Lancer docker
docker compose up -d

## Stop docker
docker compose stop

## Entrer dans le container
docker exec -it projet-php-apache /bin/bash

## Mettre les bons droits dans wp pour envoyer des fichiers
usermod -u 1000 www-data

## Compiler le front
path: ice-cream/app
npm run build - Compile les assets une seule fois
npm run dev - lance le watcher
