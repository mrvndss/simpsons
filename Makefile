start: install build
	cd client && npm run preview

install: docker vendor artisan node_modules

vendor:
	bin/composer install

artisan:
	bin/artisan migrate

node_modules:
	cd client && npm install

build:
	cd client && npm run build

docker:
	docker-compose up -d