build:
	@docker-compose build

up:
	@docker-compose up -d

stop:
	@docker-compose stop

down:
	@docker-compose down

bash:
	@docker-compose exec php /bin/bash

validate-schema:
	@docker-compose exec -T php php bin/console doctrine:schema:validate

cache-clear:
	@docker-compose exec -T php php bin/console cache:clear


