# CraftedBy - API

## Project info 

This project is the backend API part of the ecommerce site "CraftedBy".

## Requisites

Required dependencies for the CraftedBy API project:

- PHP 8.0 or higher
- Composer 2.0 or higher
- MariaDB 10.4 or higher

Make sure that you have these dependencies installed on your system before installing the project. 
You can check if you have PHP, Composer and MariaDB installed by running the following commands in your terminal:

```
php --version
composer --version
mysql --version
```

If you don't have PHP, Composer or MariaDB installed, you can download and install them from their respective websites.

## Installation

1. Clone the repository to your local machine:

```
git clone https://github.com/Adrew-Kirts/craftedby-backend.git
```

2. Navigate to the project directory:

```
cd craftedby-backend
```

3. Install the project dependencies using Composer:

```
composer install
```

4. Copy the `.env.example` file to `.env`:

```
cp.env.example.env
```

5. Generate a new application key:

```
php artisan key:generate
```

6. Set the database connection in the `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

7. Run the database migrations:

```
php artisan migrate
```

8. Start the development server:

```
php artisan serve
```

You should now be able to access the API on `localhost`. See the API list for possible routes.

-----

## API routes

