# Utiliser une image PHP
FROM php:8.2-apache

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copier le code source de l'application dans le conteneur
COPY dm-web/. /var/www/html

# Installer les dépendances nécessaires
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev && \
    docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install gd mysqli pdo pdo_mysql

# Exposer le port 80
EXPOSE 80

# Point d'entrée pour démarrer Apache
CMD ["apache2-foreground"]
