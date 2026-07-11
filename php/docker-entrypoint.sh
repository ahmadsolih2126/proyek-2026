#!/bin/bash
set +e

echo "🚀 Starting Laravel container setup..."

# 1. Install/Update vendor (hanya jika belum ada)
if [ ! -d /var/www/html/vendor ]; then
  echo "📦 Installing composer dependencies..."
  composer install --no-interaction --prefer-dist
fi

# 2. Setup folder & Permission
echo "🔧 Fixing permissions..."
mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 3. Tunggu DB Ready
echo "⏳ Waiting for database..."
until nc -z db 3306; do
  sleep 2
done
echo "✅ Database is ready!"

# 4. Migrasi (|| true agar kontainer tetap Up jika migrasi gagal)
php artisan migrate --force || true
php artisan storage:link || true

echo "✅ Laravel setup complete!"

# Jalankan PHP-FPM
exec "$@"