#!/bin/bash
set -e

PORT="${PORT:-80}"

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
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# ── 2. Initialise local MySQL (only on first boot) ──────────────────
MYSQL_DATA_DIR=/var/lib/mysql

if [ ! -d "$MYSQL_DATA_DIR/mysql" ]; then
    echo "Initialising MySQL data directory..."
    mysqld --initialize-insecure --user=mysql --datadir=$MYSQL_DATA_DIR
fi

# Start MySQL temporarily to set up DB and user
echo "Starting MySQL for setup..."
mysqld_safe --user=mysql --skip-networking &
MYSQL_PID=$!

# Wait until MySQL socket is ready
for i in $(seq 1 30); do
    if mysqladmin ping --socket=/var/run/mysqld/mysqld.sock --silent 2>/dev/null; then
        break
    fi
    echo "  Waiting for MySQL socket... ($i/30)"
    sleep 2
done

DB_NAME_LOCAL="${DB_NAME:-bank_db}"
DB_USER_LOCAL="${DB_USER:-bankuser}"
DB_PASS_LOCAL="${DB_PASS:-bankpass}"

echo "Creating database and user..."
mysql --socket=/var/run/mysqld/mysqld.sock <<SQL
CREATE DATABASE IF NOT EXISTS \`${DB_NAME_LOCAL}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USER_LOCAL}'@'localhost' IDENTIFIED BY '${DB_PASS_LOCAL}';
GRANT ALL PRIVILEGES ON \`${DB_NAME_LOCAL}\`.* TO '${DB_USER_LOCAL}'@'localhost';
FLUSH PRIVILEGES;
SQL

echo "Applying db_setup.sql..."
mysql --socket=/var/run/mysqld/mysqld.sock \
      -u"${DB_USER_LOCAL}" -p"${DB_PASS_LOCAL}" \
      "${DB_NAME_LOCAL}" < /var/www/html/db_setup.sql && echo "db_setup.sql applied." || echo "db_setup.sql warnings (safe to ignore if tables already exist)."

# Stop the temporary MySQL process — supervisor will restart it properly
kill $MYSQL_PID
wait $MYSQL_PID 2>/dev/null || true
echo "MySQL setup complete."

# ── 3. Hand off to supervisor (runs MySQL + Apache together) ─────────
echo "Starting supervisor (MySQL + Apache) on port ${PORT}..."
mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
