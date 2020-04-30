# Laravel Form Builder

This is a basic laravel form builder project.
## Getting started

### Installation


Clone the repository:

``` bash
git clone https://github.com/xinnah/form-builder.git
```

Switch to the repo folder

``` bash
cd form-builder
```

Install all the dependencies using composer

``` bash
composer install
```

Copy the example env file and make the required configuration changes in the .env file

``` bash
cp .env.example .env
```

Generate a new application key

``` bash
php artisan key:generate
```

Run the database migrations (Set the database connection in .env before migrating)

``` bash
php artisan migrate
```

Start the local development server

``` bash
php artisan serve
```

You can now access the server at http://localhost:8000

Thank You.
