FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
ENV DB_HOST=mariadb
ENV DB_NAME=rodados_del_sudeste
ENV DB_USER=root
ENV DB_PASSWORD=123456
COPY . /var/www/html/
EXPOSE 80