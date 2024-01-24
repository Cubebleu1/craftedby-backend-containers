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

This documentation provides information on the API routes and endpoints available in the application.

## Routes

### Authentication Routes

- `POST /api/login`: Authenticates user based on password and email and creates a new API token.
- `POST /api/logout`: Logs out current user and deletes access token.

### User Routes

- `GET /api/users`: Returns a list of all users.
- `POST /api/users`: Creates a new user.
- `GET /api/users/{id}`: Returns the details of a specific user.
- `PUT /api/users/{id}`: Updates the details of a specific user.
- `DELETE /api/users/{id}`: Deletes a specific user.

### Product Routes

- `GET /api/products`: Returns a list of all products.
- `POST /api/products`: Creates a new product.
- `GET /api/products/{id}`: Returns the details of a specific product.
- `PUT /api/products/{id}`: Updates the details of a specific product.
- `DELETE /api/products/{id}`: Deletes a specific product.

### Category Routes

- `GET /api/categories`: Returns a list of all categories.
- `POST /api/categories`: Creates a new category.
- `GET /api/categories/{id}`: Returns the details of a specific category.
- `PUT /api/categories/{id}`: Updates the details of a specific category.
- `DELETE /api/categories/{id}`: Deletes a specific category.

### Review Routes

- `GET /api/reviews`: Returns a list of all reviews.
- `POST /api/reviews`: Creates a new review.
- `GET /api/reviews/{id}`: Returns the details of a specific review.
- `PUT /api/reviews/{id}`: Updates the details of a specific review.
- `DELETE /api/reviews/{id}`: Deletes a specific review.

### Business Routes

- `GET /api/businesses`: Returns a list of all businesses.
- `POST /api/businesses`: Creates a new business.
- `GET /api/businesses/{id}`: Returns the details of a specific business.
- `PUT /api/businesses/{id}`: Updates the details of a specific business.
- `DELETE /api/businesses/{id}`: Deletes a specific business.

## Authentication

To authenticate with the API, you can send a POST request to the `/api/login` endpoint with the `email` and `password` parameters in the request body. 

The response will contain a JSON object with the `token` field, which is the API token for the authenticated user.

Example response body:
``` 
{
    "message": "Login successful",
    "token": "9b2b46a2-d7fc-43ba-befe-cd35a8c40df6|h6IeVlSvqLU5hpLsSjygVpdxdnITD4edNRJ68jAjf219237e"
} 
```

## Error Handling

If an error occurs while processing a request, the API will return a JSON object with an `error` field and a `message` field. The `error` field will be set to `true` if an error occurred, and `false` otherwise. The `message` field will contain a description of the error.

## License

This documentation is licensed under the MIT License.
