#!/bin/bash
set -e

# Bypass ViserLab license check by ensuring laramin.json exists
mkdir -p /app/vendor/laramin/utility/src
echo '{}' > /app/vendor/laramin/utility/src/laramin.json

# Run database migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache

# Create storage symlink (--force handles already-existing symlinks)
php artisan storage:link --force 2>/dev/null || true

# Start the PHP server (exec replaces bash so Railway monitors the correct PID)
exec php artisan serve --host=0.0.0.0 --port=$PORT
