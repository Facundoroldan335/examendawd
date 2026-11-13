FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y mariadb-server mariadb-client \
    && docker-php-ext-install pdo_mysql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

ENV DB_HOST=127.0.0.1
ENV DB_PORT=3306
ENV DB_NAME=rodados_del_sudeste
ENV DB_USER=rodados_user
ENV DB_PASSWORD=tu_contraseña
COPY . /var/www/html/

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]

CMD ["apache2-foreground"]
