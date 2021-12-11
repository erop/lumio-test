.PHONY: tests
tests:
	php ./vendor/bin/phpunit

up:
	docker-compose up -d --build

down:
	docker-compose down

restart: down up

ps:
	docker-compose ps

logs:
	docker-compose logs -f

db:
	docker-compose exec database sh

migrate:
	symfony console doctrine:migrations:migrate -q