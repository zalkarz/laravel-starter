#!/bin/bash

# Usage
# $ bash deploy.sh ENV_MODE

set -e
exec 2>&1

ENV_MODE=$1

case "$ENV_MODE" in
    prod*)
        echo [PRODUCTION MODE]
        ENVIRONMENT="prd"
        BRANCH_NAME="main"
        COMPOSER_OPTION="--no-dev"
        ;;
    stg*)
        echo [STAGING MODE]
        ENVIRONMENT="stg"
        BRANCH_NAME="develop"
        COMPOSER_OPTION="--no-dev"
        ;;
    *)
        echo "Usage: $0" '(prd|stg)'
        exit 1
        ;;
esac

echo "===== executing deploy.sh ====="

echo "===== git fetch ====="
echo git fetch -p
git fetch -p

echo "===== git merge ====="
echo git merge origin/${BRANCH_NAME}
git merge origin/${BRANCH_NAME}

echo "==== copy env file ===="
cp -v .env.$ENVIRONMENT .env

echo "===== deploy success ====="
echo composer install:
composer install --optimize-autoloader $COMPOSER_OPTION
composer dump-autoload
php artisan config:cache
php artisan view:clear
php artisan route:cache

SCRIPT_DIR=$(cd $(dirname $0); pwd)
[ -n "$SCRIPT_DIR" ] && {
    chown -R apache:apache ${SCRIPT_DIR}
    chmod -R a+w ${SCRIPT_DIR}/storage
}

exit 0