DOCKER_COMPOSE = docker compose
DOCKER = docker

install: start composer-install

status:
	$(DOCKER_COMPOSE) ps

start:
	$(DOCKER_COMPOSE) up --build --remove-orphans --force-recreate --detach

stop:
	$(DOCKER_COMPOSE) stop

kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

clean: kill
	rm -rf var vendor

composer-install:
	$(DOCKER_COMPOSE) exec americor-php composer install

migrate:
	$(DOCKER_COMPOSE) exec americor-php php bin/console doctrine:migrations:migrate

migrate-prev:
	$(DOCKER_COMPOSE) exec americor-php php bin/console doctrine:migrations:migrate prev

migrate-diff:
	$(DOCKER_COMPOSE) exec americor-php php bin/console doctrine:migrations:diff

fixture-load:
	$(DOCKER_COMPOSE) exec americor-php php bin/console doctrine:fixture:load --env=test

deptrac-layers-analyse:
	$(DOCKER_COMPOSE) exec americor-php vendor/bin/deptrac analyse --config-file=deptrac-layers.yaml

deptrac-modules-analyse:
	$(DOCKER_COMPOSE) exec americor-php vendor/bin/deptrac analyse --config-file=deptrac-modules.yaml

phpstan-analyse:
	$(DOCKER_COMPOSE) exec americor-php vendor/bin/phpstan analyse

php-cs-fixer:
	$(DOCKER_COMPOSE) exec americor-php vendor/bin/php-cs-fixer fix

tests:
	$(DOCKER_COMPOSE) exec americor-php vendor/bin/phpunit
