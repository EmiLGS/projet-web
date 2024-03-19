# Use the official Apache2 image as the database server
FROM apache2:latest

# Use the official PHP image as the base image
FROM php:latest

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo_mysql

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the PHP application files to the container
COPY . /var/www/html

# Expose port 80 for web traffic
EXPOSE 80

# Use the official MySQL image as the database server
FROM mysql:latest

# Set the root password for MySQL
ENV MYSQL_ROOT_PASSWORD=Emilien030702

# Create a new database
ENV MYSQL_DATABASE=programming_languages

# Copy the SQL script to initialize the database
COPY init.sql /docker-entrypoint-initdb.d/

# Expose port 3306 for MySQL connections
EXPOSE 3306

