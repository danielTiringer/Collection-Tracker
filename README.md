# docker-compose-laravel

A pretty simplified docker-compose workflow that sets up a LEMP network of containers for local Laravel development.

### Install Docker

To get started, make sure you have Docker installed on your system, and then clone this repository.

### Create a Laravel app

Creating a new Laravel application is handled by spinning up a Composer Docker container to generate it.
Keep the project name laravel (the last argument), as the containers expect to use that folder.
Different Laravel versions can be used by appending a version number, e.g. `laravel/laravel:5.2.29`.

```
docker-compose run --rm php composer create-project --prefer-dist laravel/laravel .
```

### Configure Laravel

Update the following in the Laravel `.env` file:
`DB_CONNECTION=pgsql`
`DB_HOST=postgres`
`APP_URL=http://localhost:4200`

### Start the containers

From the respository's root run `docker-compose up -d --build`. Open up your browser of choice to [http://localhost:4200](http://localhost:4200) and you should see your Laravel app running as intended.

- `docker-compose run --rm php composer update`
- `docker-compose run --rm php artisan migrate`
- `docker-compose run --rm php composer stan`

Containers created and their ports (if used) are as follows:

- **php** - `:4200`
- **postgres** - `:5432`

### Migrations, database seed

Run the following command:
```shell
docker-compose run --rm php php artisan migrate:refresh --seed
```

### Troubleshooting

<!-- The following issues have occurred: -->

### Resources

