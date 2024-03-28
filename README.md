# CraftedBy - API

## Project info 

This project is the backend API part of the ecommerce site "CraftedBy".

## Requisites

Required dependencies for the CraftedBy API project:

- PHP 8.0 or higher
- Composer 2.0 or higher
- MariaDB 10.4 / MySQL 8.0 or higher

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

Optional:

Seed database with all existing entities to populate catalogue:
```
php artisan db:seed --class=DatabaseSeeder  
```


8. Start the development server:

```
php artisan serve
```

You should now be able to access the API on `localhost`. See the API list for possible routes.

-----

## API routes

This documentation provides information on the API routes and endpoints available in the application.

### OpenAPI documentation of routes

Launch backend server and visit:

http://localhost:8000/api/documentation

for a list of all routes (Swagger)

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

## Creation of a User

- `POST /api/users`: Creates a new user.

With JSON body:

```
{
    "first_name": "Yolo",
    "last_name": "Doe",
    "address" : "13, La Rue",
    "postal_code" : "74000",
    "city": "Annecy",
    "phone_number": "0612345678",
    "email": "john@xit.com",
    "password": "password"
}
```

Returns code 201 with body:

```
{
    "message": "User successfully registered",
    "created user": {
        "first_name": "Yolo",
        "last_name": "Doe",
        "address": "13, La Rue",
        "postal_code": "74000",
        "city": "Annecy",
        "phone_number": "0612345678",
        "email": "john@xit.com",
        "id": "9b2cf829-901f-44d0-bd9b-3cabf41b3ddb",
        "updated_at": "2024-01-25T09:20:43.000000Z",
        "created_at": "2024-01-25T09:20:43.000000Z"
    }
}
```

## Authentication

To authenticate with the API, you can send a POST request to the `/api/login` endpoint with the `email` and `password` parameters in the request body. 

The response will contain a JSON object with the `token` field, which is the API token for the authenticated user.

Example response body:
``` 
{
    "message": "Login successful",
    "token": "9b2cf968-f6f0-4846-9887-a3743718a7da|I5DzbQP9Bus8DT8TmWeFc5gHrlu7y9nr4vWrjXif42ea2383"
}
```

## Using API token

In the case of wanting to use a protected rout where a regular_user can only view its own user data;

E.g. `GET /api/users/{id}`: Returns the details of a specific user.
 
The API token (Bearer token) should be sent with the request.

## Error Handling

If an error occurs while processing a request, the API will return a JSON object with an `error` field and a `message` field. The `error` field will be set to `true` if an error occurred, and `false` otherwise. The `message` field will contain a description of the error.

## Debugging

**Telescope** provides insight into the requests coming into the application, exceptions, log entries, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, variable dumps and more.

To use telescope follow the `/telescope` url   

## License

This documentation is licensed under the MIT License.
