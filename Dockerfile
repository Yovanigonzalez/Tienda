# Usa una imagen base de PHP
FROM php:7.4-apache

# Copia los archivos de tu aplicación al contenedor
COPY . /var/www/html/

# Expone el puerto 80 para el servidor web Apache
EXPOSE 80

# Define el directorio de trabajo
WORKDIR /var/www/html/
