# Collection Tracker

[![Build Status](https://github.com/danielTiringer/Collection-Tracker/actions/workflows/ci.yml/badge.svg)](https://github.com/danielTiringer/Collection-Tracker/actions)

I wanted to have a small site with a database where I could save the collections I manage, with pictures and item details.

## Learnings

- Trying out **CakePHP** for the first time
- Making most containers run on **Alpine**
- First glance at **Github Actions**

## Usage

### Install Docker

To get started, make sure you have Docker installed on your system, and then clone this repository.

### Create a CakePHP app

Creating a new CakePHP application is handled by spinning up a Docker container to generate it.
Find the details about CakePHP applications on the [Cake Framework documentation site](https://book.cakephp.org/4/en/installation.html).

```sh
docker-compose run --rm -u root php composer create-project --prefer-dist cakephp/app:~4.2 .
```
Because containers are run as `root` in base Docker containers, the files created by the composer script are owned by `root`. To allow local editing of the Cakeapplication files, change the owner of the files to the current user:
```sh
sudo chown -R $USER:$USER .
```

### Connect to a database

In order to connect to a database, the following updates are required in the `src/config/app_local.example.php`'s `Datasources['default']` array (and it gets copied to `app_local.php`):

``` php
            'driver' => 'Cake\Database\Driver\Postgres',
            'host' => 'postgres',
            'username' => env('POSTGRES_USER', 'my_app'),
            'password' => env('POSTGRES_PASSWORD', 'secret'),
            'database' => env('POSTGRES_DB', 'my_app'),l
```

### Start the containers

From the respository's root run `docker-compose up -d --build`. Open up your browser of choice to [http://localhost:4000](http://localhost:4000) and you should see the app running as intended.

The main container can handle Composer and Cake commands without having to have these installed on your local computer. Use the following command templates from your project root, modifiying them to fit your particular use case:

``` sh
docker-compose run --rm -u root php composer update
docker-compose run --rm -u root php composer test # Runs the test suite
docker-compose run --rm -u root php composer check # Runs the test suite and codesniffer
docker-compose run --rm -u root php bin/cake bake migration # Add the migration details after this
docker-compose run --rm -u root php bin/cake migrations migrate
```

Containers created and their ports (if used) are as follows:

- **php** - `:4000`
- **postgresql** - `:5432`

### Troubleshooting

- Cake comes with a github actions CI workflow installed. If that is to be used, move the `src/.github` folder to the document root, add [default working directories](https://docs.github.com/en/actions/reference/workflow-syntax-for-github-actions#jobsjob_iddefaultsrun) to each job, and rename / remove all **php 7.2** references, as some of the installed dependencies are not compatible with it.

- The `src/logs` and `src/tmp` folders can have permission errors. Run:

``` sh
sudo chmod -R 777 src/logs src/tmp
```

### Resources

- [CakePHP documentation](https://book.cakephp.org/4/en/quickstart.html)
