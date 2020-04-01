# Laravel & Nuxt Ecommerce.
    this is a simple laravel & nuxt ecommerce app i'm using jwt for token generation and bulma as css framework.

## Structure
    - this is a normal laravel app but i added a directory "client" in the base path that contains nuxtjs app.

## Install on your machine.

### Backend
    - `composer install`
    - `cp .env.example .env` then fill your data.
    - run `php artisan jwt:secret` to generate a secret token.
### Client
    - go to the backend base path then `cd client`
    - `npm install` to install npm packages.
    - `npm run dev` for development environment
