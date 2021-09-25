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
