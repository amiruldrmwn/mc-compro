#!/bin/sh
# Prepares the /data volume and the database, then starts the given command (supervisord).
set -e
cd /app

if [ -z "$APP_KEY" ]; then
    echo "APP_KEY is not set: set it in the service's environment." >&2
    exit 1
fi

mkdir -p /data/uploads
[ -f /data/database.sqlite ] || touch /data/database.sqlite

# Uploads live in the volume: storage/app/public points at it.
rm -rf storage/app/public
ln -sfn /data/uploads storage/app/public
php artisan storage:link --force >/dev/null 2>&1 || true

php artisan migrate --force
php artisan compro:ensure-admin
php artisan compro:install-content
php artisan optimize

chown -R www-data:www-data /data /config storage bootstrap/cache

exec "$@"
