#!/bin/bash
set -e

export PORT="${PORT:-10000}"
MYSQL_SOCKET="/var/run/mysqld/mysqld.sock"
MYSQL_DATA_DIR="/var/lib/mysql"
DB_NAME_LOCAL="${DB_NAME:-bank_db_copy_1}"
DB_USER_LOCAL="${DB_USER:-bankuser}"
DB_PASS_LOCAL="${DB_PASS:-bankpass}"

echo "==> Using PORT=${PORT}"

# ── 1. Fix Apache port ──────────────────────────────────────────────
cat > /etc/apache2/ports.conf <<EOF
Listen 0.0.0.0:${PORT}
<IfModule ssl_module>
    Listen 443
</IfModule>
<IfModule mod_gnutls.c>
    Listen 443
</IfModule>
EOF
sed -i "s|<VirtualHost \*:[0-9]*>|<VirtualHost *:${PORT}>|" /etc/apache2/sites-available/000-default.conf
echo "==> Apache configured to listen on ${PORT}"

# ── 2. Prepare MySQL directories ─────────────────────────────────────
mkdir -p /var/run/mysqld /var/log/mysql
chown -R mysql:mysql /var/run/mysqld /var/log/mysql

# Initialise data directory on first boot
if [ ! -d "$MYSQL_DATA_DIR/mysql" ]; then
    echo "==> Initialising MySQL data directory..."
    mysqld --initialize-insecure --user=mysql --datadir=$MYSQL_DATA_DIR
fi

# Clean stale socket
rm -f "$MYSQL_SOCKET"

# ── 3. Start MySQL temporarily for DB/user setup ─────────────────────
echo "==> Starting MySQL for initial setup..."
mysqld --user=mysql \
       --socket=$MYSQL_SOCKET \
       --skip-networking \
       --background

echo "==> Waiting for MySQL socket..."
for i in $(seq 1 30); do
    if mysqladmin ping --socket=$MYSQL_SOCKET --silent 2>/dev/null; then
        echo "==> MySQL ready after ${i}s"
        break
    fi
    sleep 2
done

echo "==> Creating database and user..."
mysql --socket=$MYSQL_SOCKET -u root <<SQL
CREATE DATABASE IF NOT EXISTS \`${DB_NAME_LOCAL}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USER_LOCAL}'@'localhost' IDENTIFIED BY '${DB_PASS_LOCAL}';
GRANT ALL PRIVILEGES ON \`${DB_NAME_LOCAL}\`.* TO '${DB_USER_LOCAL}'@'localhost';
FLUSH PRIVILEGES;
SQL

echo "==> Applying db_setup.sql..."
mysql --socket=$MYSQL_SOCKET -u root "${DB_NAME_LOCAL}" < /var/www/html/db_setup.sql \
  && echo "==> db_setup.sql applied." \
  || echo "==> db_setup.sql warnings (safe if tables already exist)."

# ── 4. Shut down the temp MySQL cleanly ──────────────────────────────
echo "==> Stopping temporary MySQL..."
mysqladmin --socket=$MYSQL_SOCKET -u root shutdown
sleep 2
rm -f "$MYSQL_SOCKET"
echo "==> MySQL setup complete."

# ── 5. Start supervisor (MySQL + Apache) ─────────────────────────────
echo "==> Starting supervisor on port ${PORT}..."
mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
