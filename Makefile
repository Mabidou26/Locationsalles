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

rebuild: ## Réinitialise la BDD et charge les fixtures
	symfony console doctrine:database:drop --force
	symfony console doctrine:database:create
	symfony console doctrine:migrations:migrat
