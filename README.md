# Laravel Starter
It is a Laravel 10.x based simple starter project.

## Docker environment
```shell
# web server
$ nginx -V
nginx version: nginx/1.24.0
built by gcc 12.2.1 20220924 (Alpine 12.2.1_git20220924-r4) 
built with OpenSSL 3.0.7 1 Nov 2022 (running with OpenSSL 3.0.9 30 May 2023)
TLS SNI support enabled

# php
$ php -v
PHP 8.2.7 (cli) (built: Jul  4 2023 14:32:22) (NTS) 
Copyright (c) The PHP Group
Zend Engine v4.2.7, Copyright (c) Zend Technologies

# Laravel
$ php artisan --version
Laravel Framework 10.7.1

# mysql
$ mysql -V
mysql  Ver 8.0.25 for Linux on x86_64 (MySQL Community Server - GPL)
```

## Start-up (macOS)
1. .env create
```shell
# Prepare environment variables
$ cp .env.dev .env
```

2. Start Docker container
```shell
$ docker-compose up -d --build
```

3. Install application dependencies
```shell
$ docker exec php_${APP_NAME}_app composer install
```

## Application URL
http://localhost:8081/
Port can be changed by changing `APP_PORT` in your `.env` file, before building the docker

## Artisan commands
All artisan commands should start with "docker exec php_${APP_NAME}_app", <br> 
so all commands will be executed inside a docker container. <br>

e.g.
```shell
$ docker exec php_${APP_NAME}_app php artisan migrate
$ docker exec php_${APP_NAME}_app php -v
$ docker exec php_${APP_NAME}_app composer --version
etc.
```

## Custom artisan commands
#### "php artisan make:crud" command: creates ready to use CRUD for any model
```
# creates CRUD for model Post
$ docker exec php_${APP_NAME}_app php artisan make:crud Post

# creates CRUD for model News
$ docker exec php_${APP_NAME}_app php artisan make:crud News

etc...
```

## Deployment
Simple bash script **./build.sh** file for deployment
```shell
echo "===== fetch ====="
git fetch -p

echo "===== merge ====="
echo git merge origin/${BRANCH_NAME}
git merge origin/${BRANCH_NAME}

echo "==== copy env file ===="
cp .env.$ENVIRONMENT .env

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
```

Run it every time you deploy
```shell
$ sudo bash deploy.sh [stg|prod]
```
Confirmed for macOS/Linux
