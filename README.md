# Setting Up the Developer Environment for Laravel API Application

Follow these steps to set up your development environment:

1. **Copy the example environment file to a new `.env` file**:

    ```sh
    cp .env.example .env
    ```

2. **Build and start the Docker containers**:

    ```sh
    docker-compose up -d --build
    ```

3. **Install Composer dependencies**:

    ```sh
    docker-compose exec app composer install
    ```

4. **Generate the application key**:

    ```sh
    docker-compose exec app php artisan key:generate
    ```

5. **Run the database migrations**:

    ```sh
    docker-compose exec app php artisan migrate
    ```

6. **(Optional) Seed the database**:

    ```sh
    docker-compose exec app php artisan db:seed
    ```

Your Laravel API application should now be up and running in the development environment.

**Note:**
**The frontend can find API Swagger documentation at `/api/documentation`.**
