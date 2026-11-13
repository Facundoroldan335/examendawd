#!/bin/bash
set -e

PORT="${PORT:-80}"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-3306}"
DB_NAME="${DB_NAME:-rodados_del_sudeste}"
DB_USER="${DB_USER:-rodados_user}"
DB_PASSWORD="${DB_PASSWORD:?Falta configurar DB_PASSWORD}"

sed -ri "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

if [ ! -d /var/lib/mysql/mysql ]; then
    mariadb-install-db --user=mysql --datadir=/var/lib/mysql --skip-test-db
fi

mkdir -p /run/mysqld
chown -R mysql:mysql /run/mysqld /var/lib/mysql

mariadbd --user=mysql --bind-address=127.0.0.1 --port="${DB_PORT}" &

for i in $(seq 1 60); do
    if mariadb-admin --protocol=socket -uroot ping >/dev/null 2>&1; then
        break
    fi
    sleep 1
done

mariadb --protocol=socket -uroot <<SQL
CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\`;
CREATE USER IF NOT EXISTS '${DB_USER}'@'127.0.0.1' IDENTIFIED BY '${DB_PASSWORD}';
CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASSWORD}';
ALTER USER '${DB_USER}'@'127.0.0.1' IDENTIFIED BY '${DB_PASSWORD}';
ALTER USER '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASSWORD}';
GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'127.0.0.1';
GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost';
FLUSH PRIVILEGES;
SQL

TABLE_COUNT=$(mariadb --protocol=socket -uroot -Nse "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='${DB_NAME}'")

if [ "$TABLE_COUNT" -eq 0 ]; then
    mariadb --protocol=socket -uroot "${DB_NAME}" < /var/www/html/schema.sql
fi

exec "$@"
