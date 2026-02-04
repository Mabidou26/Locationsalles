.PHONY: help install rebuild

ifdef APP_ENV
APP_ENV := $(APP_ENV)
else
APP_ENV := dev
endif

help: ## Affiche les commandes disponibles
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Installe les dépendances et crée la base
	composer install
	symfony console doctrine:database:create
	symfony console lexik:jwt:generate-keypair

cache-clear: ## Vide le cache
	php bin/console cache:clear
    php bin/console cache:warmup

rebuild: ## Réinitialise la BDD et charge les fixtures
	symfony console doctrine:database:drop --force
	symfony console doctrine:database:create
	symfony console doctrine:migrations:migrate

fixtures: symfony console doctrine:fixtures:load --no-interaction

test: ## Lance les tests
	php bin/console app:validate-entities
	php bin/phpunit

admin: ## Ouvre le dashboard admin
	@echo "Dashboard admin: http://localhost:8000/admin"

api: ## Ouvre la doc API
	@echo "Documentation API: http://localhost:8000/api"