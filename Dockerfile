# This file is only used for the application to be run in a container.
# SQL container is needed to be used. 
# A docker file for SQL is available in the mysql folder.


# Utilisation de l'image PHP officielle
FROM php:8.2-apache

# Installer les dépendances nécessaires
RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        unzip \
        git \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install gd pdo pdo_mysql zip

# Copier les fichiers de l'application dans le conteneur
COPY . /var/www/html/

# Définir le répertoire de travail
WORKDIR /var/www/html

# Exposer le port Apache
EXPOSE 80

# Commande pour démarrer Apache
CMD ["apache2-foreground"]
