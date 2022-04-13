# Teste M2 Digital - WEB - Backend

## Single Page Application

Comandos para iniciar o código:

Requerimento: PHP 8.0

```shell
composer install

cp .env.example .env

npm install

npm run dev

sail up
```

Apos rodar o docker:

```shell
sail artisan key:generate

sail artisan migrate
```

Para popular com os factories o banco de dados basta usar
```shell
sail artisan db:seed
```

O site irá aparecer em http://localhost:8000
