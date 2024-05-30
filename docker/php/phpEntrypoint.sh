#!/usr/bin/env sh

set -e

printf "\n\nStarting PHP 8.2 daemon...\n\n"

composer install && php artisan migrate && php artisan db:seed && php artisan storage:link

exec "$@"