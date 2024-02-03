# docker-compose-laravel

A pretty simplified docker-compose workflow that sets up a LEMP network of containers for local Laravel development,
with another container hot-reloading a React frontend application.

### Install Docker

To get started, make sure you have Docker installed on your system, and then clone this repository.

### Create a Laravel app

Creating a new Laravel application is handled by spinning up a Composer Docker container to generate it.
Keep the project name laravel (the last argument), as the containers expect to use that folder.
Different Laravel versions can be used by appending a version number, e.g. `laravel/laravel:5.2.29`.

```
docker-compose run --rm api composer create-project --prefer-dist laravel/laravel .
```
### Create a new React based application

Run the command below to create a new React application:
``` bash
docker-compose run --rm client yarn create vite . --template react-ts
```
To install the required dependencies, also run:
``` bash
docker-compose run --rm client yarn
```
Also add the following to the `vite.config.ts`'s `defineConfig`:
``` typescript
  server: {
    host: true,
    port: 8080,
    watch: {
      usePolling: true,
    },
  },
```

### Configure Laravel

Update the following in the Laravel `.env` file:
`DB_CONNECTION=pgsql`
`DB_HOST=postgres`
`APP_URL=http://localhost:4200`

### Start the containers

From the respository's root run `docker-compose up -d --build`. Open up your browser of choice to [http://localhost:4200](http://localhost:4200) and you should see your Laravel app running as intended.

- `docker-compose run --rm api composer update`
- `docker-compose run --rm api artisan migrate`
- `docker-compose run --rm api composer stan`
- `docker-compose run --rm client yarn add @instructure/ui`

Containers created and their ports (if used) are as follows:

- **client** - `:4300`
- **api** - `:4200`
- **database** - `:3306`

### Migrations, database seed

Run the following command:
```shell
docker-compose run --rm api php artisan migrate:refresh --seed
```

### Troubleshooting

<!-- The following issues have occurred: -->

### Resources

