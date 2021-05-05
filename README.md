### Introduction

**Laravel-solid-architecture** offers you to do modern API development in Laravel. Project has also support for new versions of Laravel.

**Laravel-solid-architecture** comes included with...

* Laravel jwt for OAuth Authentication
* A modern exception handler for APIs.
* A base repository class for requesting entities from your database.



```bash
git clone https://github.com/KhalidEdaig/Laravel-solid-architecture && cd Laravel-solid-architecture && composer install 
```

This will:

- Create the project.
- Install the dependencies.
- Copy the .env.example to .env in the project root.
- Generate the `APP_KEY`.
- Generate the `JWT_SECRET`

Update your `.env` file as needed;

### Manual Installation

First clone the repository.
```bash
git clone https://github.com/KhalidEdaig/Laravel-solid-architecture
```

Install dependencies.

```bash
composer install
```

Copy the `.env` file an create and application key.

```
cp .env.example .env && php artisan key:generate
```

Migrate the tables.

```
php artisan migrate
```
