# Demo Simpsons API

## Tech Stack

- [SvelteKit](https://github.com/sveltejs/kit)
- [Lumen](https://github.com/laravel/lumen)
- [tailwindcss](https://github.com/tailwindlabs/tailwindcss)

## Getting started

### Requirements

- Docker
- node

### Automatic installation

To get started just clone the repo and use following command:

```
make start
```

### Manual installation

For manual installation follow these steps:

```
docker-compose up -d
bin/composer install
bin/artisan migrate
cd client && npm install && npm run build && npm run preview
```

The project should run at http://localhost:4173/
