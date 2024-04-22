# Utilisation de l'image MySQL officielle
FROM mysql:8.0

# Définir les variables d'environnement
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=programming_languages
ENV MYSQL_USER=user
ENV MYSQL_PASSWORD=User1234

# Copier le fichier SQL d'initialisation
COPY init.sql /docker-entrypoint-initdb.d/

# Exposer le port MySQL
EXPOSE 3306
