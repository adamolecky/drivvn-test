## Decription
This is test project for Drivvn company done by Adam Olecký. Project runs in dockerized enviroment using Symfony framework and Doctrine ORM.

## Getting Started

1. Run `docker compose up --build --force-recreate -d` (no need to force recreate or build flags fo fist run, but generally this is also 'reset images and containers' command)
2. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
3. Cli to php container to run commands: `docker exec -it symfony-docker-php-1 /bin/sh`

## What's next?

Project should be set by now. You could use makefile in root folder or execute following commands in container manually (for example if name collision prevents script from running) to reset DB if corrupted. 

### Run inside php container:
1. run creation of DB: `bin/console doctrine:database:create`
2. run migrations: `bin/console doctrine:migrations:migrate`
3. run fixtures: `bin/console doctrine:fixtures:load`
4. run creation of test DB: `bin/console -env=test docntrine:schema:create`
5. if you are annoyed by deprecated stuff showing in cli run: `export SYMFONY_DEPRECATIONS_HELPER=weak`

## Run tests

Because there are application tests is involving test DB, there is need to populate tables with fixtures first.

### Run inside php container:
1. `php bin/console --env=test doctrine:fixtures:load` to populate test DB
2. `php bin/phpunit` to run unit tests

##

## Summary
That should be enough to run test project. After loading fixtures it should contain one car, 4 colors (colours) in app DB. 
