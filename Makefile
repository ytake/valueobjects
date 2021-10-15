SHELL := /usr/bin/env bash

up:
	export UID && docker-compose up -d
	bin/wait_for_docker.bash "Generating autoload files"

down:
	docker-compose down -v

build:
	docker-compose build

bash:
	export UID && docker-compose run php bash

tests:
	export UID && docker-compose run --rm php bash -c "vendor/bin/phpunit --coverage-clover tests/logs/clover.xml"
.PHONY: tests

phpcs:
	docker-compose run --rm php bash -c "vendor/bin/phpcs --ignore=vendor -n src"

phpcbf:
	docker-compose run --rm php bash -c "vendor/bin/phpcbf --ignore=vendor -n src"

securitychecker:
	docker-compose run --rm php bash -c "symfony local:check:security"

docker_clean:
	docker rm $(docker ps -a -q) || true
	docker rmi < echo $(docker images -q | tr "\n" " ")
