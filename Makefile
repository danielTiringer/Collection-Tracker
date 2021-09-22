.PHONY: env init

USER = $(shell whoami)
PWD = $(shell pwd)

env:
	test -f .env || cp env.example .env

init:
	docker-compose up -d database && \
	docker-compose run --rm php composer install && \
	docker-compose run --rm cake migrations migrate && \
	docker-compose down

create-test-db:
	docker-compose up -d database && \
	sleep 5 && \
	docker exec collection-tracker-database mysql \
		--user=root \
		--password=${MYSQL_ROOT_PASSWORD} \
		-e "CREATE DATABASE IF NOT EXISTS test_database; GRANT ALL PRIVILEGES ON test_database.* TO '${MYSQL_USER}'@'%'; FLUSH PRIVILEGES;"
	docker-compose down
