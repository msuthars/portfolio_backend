# Portfolio Backend

A Laravel backend that provides portfolio data to a separate frontend application through an API. It is intended to keep portfolio content and its delivery independent from the frontend.

## Requirements

- PHP version supported by the Laravel version used by this project
- Composer
- A database supported by Laravel
- Node.js and npm if frontend assets are added to this backend

## Getting started

From the project directory:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure the database connection in `.env`, then run migrations and start the development server:

```bash
php artisan migrate
php artisan serve
```

The Laravel development server is available at `http://127.0.0.1:8000` by default. Configure the portfolio frontend to use the backend's API URL, and set up CORS in Laravel if the applications run on different origins.

## Configuration

Application and database settings are managed through environment variables in `.env`. Do not commit `.env` or other secrets. Use `.env.example` as the template for local configuration.

## API

This backend is intended to expose portfolio data for the frontend. API endpoints and their response formats should be documented here as they are implemented.

## Tests

Run the Laravel test suite with:

```bash
php artisan test
```
