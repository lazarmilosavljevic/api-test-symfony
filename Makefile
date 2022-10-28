ENGINE_EXEC=docker-compose exec engine

#######################
# DEV TASKS
#######################

init: ## Execute this command to setup the dev env
	test -f docker-compose.yaml || cp docker-compose.yaml.dist docker-compose.yaml
	docker-compose build
	docker-compose up -d --force-recreate
	${ENGINE_EXEC} php composer.phar install --prefer-dist --no-progress --no-interaction --ansi # to install vendor bundles.
	make provision-database

provision-database: ## Provision Database (create and load fixture)
	${ENGINE_EXEC} bin/console doctrine:database:drop --if-exists --force -q
	${ENGINE_EXEC} bin/console doctrine:database:create --if-not-exists -q
	${ENGINE_EXEC} bin/console doctrine:migrations:migrate --no-interaction
	${ENGINE_EXEC} bin/console doctrine:fixtures:load --no-interaction

test-unit: ## Run Unit tests
	${ENGINE_EXEC} ./vendor/bin/phpunit

stop: ## Stop all containers properly
	docker-compose stop
