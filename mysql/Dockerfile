# Utiliser une image MySQL
FROM mysql:latest

# Définir le mot de passe root pour MySQL
ENV MYSQL_ROOT_PASSWORD=root
# Créer la base de données et l'utilisateur
ENV MYSQL_DATABASE=database
ENV MYSQL_USER=user
ENV MYSQL_PASSWORD=password

# Copier le fichier SQL d'initialisation dans le conteneur
COPY dump/programming_languages.sql /docker-entrypoint-initdb.d/

# Exposer le port 3306
EXPOSE 3306