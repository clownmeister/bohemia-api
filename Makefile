PHP = docker exec -it -w /var/www bapi-php bash -c
NPM = docker exec -it -w /var/www bapi-npm bash -c

default:
	@echo "\e[102;30m******************************         Izi Start          ******************************\e[0m\n"
	@make env up install

env:
	@echo "\n\e[92mChecking for existing env file\e[0m"
	@{ \
	if [ ! -f ./.env ]; then \
		echo "\e[91mEnv not found!\e[0m Creating...";\
		cp ./.env.local ./.env;\
		chmod 755 ./.env;\
		echo "\e[92mEnv file created.\e[0m\n";\
	else \
		echo "Env file \e[92mOK\e[0m.\n";\
	fi \
	}

up:
	@docker-compose up -d --force-recreate

php:
	@echo "\e[103;30m******************************         sdk-php bash          ******************************\e[0m\n"
	docker exec -it -w /var/www bapi-php bash

npm:
	@echo "\e[103;30m******************************         sdk-php bash          ******************************\e[0m\n"
	docker exec -it -w /var/www bapi-npm bash

install:
	@echo "\e[103;30m******************************         Install          ******************************\e[0m\n"
	$(NPM) "yarn install"
	$(PHP) "composer install"
	make generate-keys

update:
	@echo "\e[103;30m******************************         Update          ******************************\e[0m\n"
	make cache-clear
	@$(PHP) "composer update"

update-browserlist:
	@$(NPM) "npx browserslist@latest --update-db"

build:
	@echo "\e[103;30m******************************         BuildAll          ******************************\e[0m\n"
	@$(NPM) "yarn buildAll"

watch:
	@echo "\e[103;30m******************************         Watch          ******************************\e[0m\n"
	@$(NPM) "yarn watchAll"

vendor:
	@echo "\e[103;30m******************************         Clearing vendor          ******************************\e[0m\n"
	@$(PHP) "rm -rf /vendor"

cache-clear:
	@echo "\e[103;30m******************************         Clearing cache          ******************************\e[0m\n"
	@$(PHP) "php bin/console cache:clear"

fix:
	@echo "\e[103;30m******************************         PHPCBF          ******************************\e[0m\n"
	@$(PHP) "./vendor/bin/phpcbf --standard=./phpcs-ruleset.xml -p src/ tests/"

phpcs:
	@echo "\e[103;30m******************************         PHPCS          ******************************\e[0m\n"
	@$(PHP) "./vendor/bin/phpcs --standard=./phpcs-ruleset.xml -p src/ tests/"

phpstan:
	@echo "\e[103;30m******************************         PHPStan          ******************************\e[0m\n"
	@$(PHP) "./vendor/bin/phpstan analyse -c phpstan.neon -l 8 src/ tests/"

test:
	@echo "\e[103;30m******************************         Test          ******************************\e[0m\n"
	make phpcs phpstan

generate-keys:
	@echo "\e[103;30m******************************         Generating JWT keypair          ******************************\e[0m\n"
	$(PHP) "php bin/console lexik:jwt:generate-keypair --skip-if-exists"

diff:
	@echo "\e[103;30m******************************         Creating diff migration          ******************************\e[0m\n"
	$(PHP) "php bin/console doctrine:migrations:diff"

migrate:
	@echo "\e[103;30m******************************         Migrating          ******************************\e[0m\n"
	$(PHP) "php bin/console --no-interaction doctrine:migrations:migrate"

drop:
	@echo "\e[103;30m******************************         Droping db          ******************************\e[0m\n"
	$(PHP) "php bin/console doctrine:schema:drop --force"
