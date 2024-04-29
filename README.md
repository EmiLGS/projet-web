# Projet-web

## Gestion de DOCKER

Tout d'abord aller dans /projet-web/mysql et lancer les commandes suivantes pour lancer la base de donnée :
```docker build -t programming-languages-database .```
```docker run -d --name programming-languages-databas -p 3306:3306 programming-languages-database```
Lancement de Apache et PHP dans le dossier projet-web:
```docker build -t programming-languages .```
```docker run -d --name programming-languages -p 8080:80 programming-languages```

## Gestion de Kubernetes
