
FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y mariadb-server mariadb-client dos2unix \
    && docker-php-ext-install pdo_mysql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

ENV DB_HOST=127.0.0.1
ENV DB_PORT=3306
ENV DB_NAME=rodados_del_sudeste
ENV DB_USER=rodados_user

COPY . /var/www/html/

RUN dos2unix /var/www/html/docker-entrypoint.sh \
    && chmod +x /var/www/html/docker-entrypoint.sh

EXPOSE 80

CMD ["/bin/bash", "/var/www/html/docker-entrypoint.sh", "apache2-foreground"]
