## Requirements
Docker: ^20
Composer: ^2

## How To Start it

1) Configure your own .env file
2) Run ```docker-compose up -d```
3) Interact with a services via `docker-compose exec {container} {command}`.

#### Here some initial commands

1) `docker-compose exec app composer install`
2) `docker-compose exec app php artisan key:generate`
3) `docker-compose exec app php artisan migrate`
