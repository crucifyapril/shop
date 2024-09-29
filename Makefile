IMAGE = shop-learn
VERSION = 1.0
WORK_DIR = /var/www

.PHONY: vendor logs tests

build:
	@docker build -t $(IMAGE):$(VERSION) ./.docker/
up:
	@docker compose up -d
down:
	@docker compose down
restart:
	@docker compose down && docker-compose up -d
php-bash:
	@docker compose exec php-shop bash
php-logs:
	@docker compose logs php-shop
nginx-bash:
	@docker compose exec nginx-shop bash
nginx-logs:
	@docker compose logs nginx-shop
redis-bash:
	@docker compose exec redis-shop bash
redis-logs:
	@docker compose logs redis-shop
vendor:
	docker run -it --rm -w $(WORK_DIR) -v .:$(WORK_DIR) --user 1000:1000 $(IMAGE):$(VERSION) composer install
key-generate:
	@docker compose exec php-shop bash -c "php artisan key:generate"
env:
	@cp .env.example .env

clean: clean-logs optimize clean-vendor
clean-logs:
	@sudo rm -fr ./.docker/logs/nginx/*
optimize:
	@docker compose exec php-shop bash -c "php artisan optimize:clear"
clean-vendor:
	@rm -fr ./vendor && rm -fr ./node_modules

npm-install:
	@docker run -it --rm -v $$(pwd):/app -w /app --user 1000:1000 node:20.17 npm i
npm-build:
	@docker run -it --rm -v $$(pwd):/app -w /app --user 1000:1000 node:20.17 npm run build
npm-dev:
	@docker run -it --rm -v $$(pwd):/app -w /app --user 1000:1000 -p 5173:5173 node:20.17 npm run dev

# Пример: make npm-run cmd='npm install -D tailwindcss'
npm-run:
	@docker run -it --rm -v $$(pwd):/app -w /app --user 1000:1000 node:20.17 $(cmd)

phpcs:
	@docker run --rm -v .:/tools/app ghcr.io/aleksandrtm/php-tools phpcs
