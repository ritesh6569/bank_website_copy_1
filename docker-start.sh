#!/bin/bash
set -e

export PORT="${PORT:-10000}"

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

# ── 2. Initialise local MySQL (only on first boot) ──────────────────
MYSQL_DATA_DIR=/var/lib/mysql
MYSQL_SOCKET=/var/run/mysqld/mysqld.sock

mkdir -p /var/run/mysqld
chown mysql:mysql /var/run/mysqld

if [ ! -d "$MYSQL_DATA_DIR/mysql" ]; then
    echo "==> Initialising MySQL data directory..."
    mysqld --initialize-insecure --user=mysql --datadir=$MYSQL_DATA_DIR
fi

# Remove stale socket if left from a previous crashed run
rm -f "$MYSQL_SOCKET"

# Start MySQL temporarily (skip-networking = no TCP, socket only)
echo "==> Starting MySQL for initial setup..."
mysqld_safe --user=mysql --skip-networking --socket=$MYSQL_SOCKET &
MYSQL_PID=$!

# Wait until MySQL socket is ready
echo "==> Waiting for MySQL socket..."
for i in $(seq 1 30); do
    if mysqladmin ping --socket=$MYSQL_SOCKET --silent 2>/dev/null; then
        echo "==> MySQL ready after ${i}s"
        break
    fi
    sleep 2
done

DB_NAME_LOCAL="${DB_NAME:-bank_db_copy_1}"
DB_USER_LOCAL="${DB_USER:-bankuser}"
DB_PASS_LOCAL="${DB_PASS:-bankpass}"

echo "==> Creating database and user..."
mysql --socket=$MYSQL_SOCKET <<SQL
CREATE DATABASE IF NOT EXISTS \`${DB_NAME_LOCAL}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USER_LOCAL}'@'localhost' IDENTIFIED BY '${DB_PASS_LOCAL}';
GRANT ALL PRIVILEGES ON \`${DB_NAME_LOCAL}\`.* TO '${DB_USER_LOCAL}'@'localhost';
FLUSH PRIVILEGES;
SQL

echo "==> Applying db_setup.sql..."
mysql --socket=$MYSQL_SOCKET \
      -u"${DB_USER_LOCAL}" -p"${DB_PASS_LOCAL}" \
      "${DB_NAME_LOCAL}" < /var/www/html/db_setup.sql \
  && echo "==> db_setup.sql applied." \
  || echo "==> db_setup.sql warnings (safe — tables may already exist)."

# Gracefully stop the temporary MySQL
echo "==> Stopping temporary MySQL..."
mysqladmin --socket=$MYSQL_SOCKET shutdown 2>/dev/null || kill $MYSQL_PID
wait $MYSQL_PID 2>/dev/null || true
rm -f "$MYSQL_SOCKET"
echo "==> MySQL setup complete."

# ── 3. Hand off to supervisor (runs MySQL + Apache together) ─────────
echo "==> Starting supervisor (MySQL + Apache) on port ${PORT}..."
mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf

echo "MySQL setup complete."

# ── 3. Hand off to supervisor (runs MySQL + Apache together) ─────────
echo "Starting supervisor (MySQL + Apache) on port ${PORT}..."
mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
