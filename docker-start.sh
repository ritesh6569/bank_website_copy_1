#!/bin/bash
# Render startup script
# Force Apache to listen on 0.0.0.0 on the port Render assigns (default 80)

PORT="${PORT:-80}"

# Overwrite ports.conf with the correct port
cat > /etc/apache2/ports.conf <<EOF
Listen 0.0.0.0:${PORT}

<IfModule ssl_module>
    Listen 443
</IfModule>
<IfModule mod_gnutls.c>
    Listen 443
</IfModule>
EOF

# Update vhost to use correct port
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# ------------------------------------------------------------------
# Wait for the Render managed MySQL to be reachable before starting
# Apache (the PHP app runs db_setup.sql on first DB connection).
# ------------------------------------------------------------------
if [ -n "$DB_HOST" ] && [ -n "$DB_PORT" ]; then
    echo "Waiting for MySQL at ${DB_HOST}:${DB_PORT} ..."
    MAX_TRIES=30
    TRIES=0
    until mysqladmin ping -h"${DB_HOST}" -P"${DB_PORT}" -u"${DB_USER}" -p"${DB_PASS}" --silent 2>/dev/null; do
        TRIES=$((TRIES + 1))
        if [ "$TRIES" -ge "$MAX_TRIES" ]; then
            echo "MySQL did not become ready in time — starting Apache anyway."
            break
        fi
        echo "  MySQL not ready yet (attempt ${TRIES}/${MAX_TRIES}), retrying in 3s ..."
        sleep 3
    done
    echo "MySQL is ready."
fi

echo "Starting Apache on 0.0.0.0:${PORT}"

# Start Apache in foreground
apache2-foreground
