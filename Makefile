IMAGE = shop-learn
VERSION = 1.0
WORK_DIR = /var/www

export IMAGE
export VERSION
export WORK_DIR

.PHONY: vendor logs tests artisan


build:
	@docker compose build --build-arg IMAGE=$(IMAGE) --build-arg VERSION=$(VERSION)
up:
	@docker  compose up -d
down:
	@docker compose down
restart:
	@docker compose down && docker-compose up -d

logs:
	@docker compose logs -f

vendor:
	@docker run -it --rm -w $(WORK_DIR) -v .:$(WORK_DIR) --user 1000:1000 $(IMAGE):$(VERSION) composer install
migrate:
	@docker run -it --rm -w $(WORK_DIR) -v .:$(WORK_DIR) --network=web-network-shop --user 1000:1000 $(IMAGE):$(VERSION) php artisan migrate
seed:
	@docker run -it --rm -w $(WORK_DIR) -v .:$(WORK_DIR) --network=web-network-shop --user 1000:1000 $(IMAGE):$(VERSION) php artisan db:seed
env:
	@cp .env.example .env
key-generate:
	@docker run -it --rm -w $(WORK_DIR) -v .:$(WORK_DIR) --user 1000:1000 $(IMAGE):$(VERSION) php artisan key:generate

# Пример: make artisan c='php artisan tinker'
artisan:
	@docker run -it --rm -v .:$(WORK_DIR) --network=web-network-shop --user 1000:1000 $(IMAGE):$(VERSION) $(c)
optimize:
	@docker run -it --rm -v .:$(WORK_DIR) --network=web-network-shop --user 1000:1000 $(IMAGE):$(VERSION) php artisan optimize:clear

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
