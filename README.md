# Shipments

## Description

Shipments is a PHP application designed to efficiently manage and track shipment data. It offers a robust system for handling various aspects of shipment management, including data entry, updates, and tracking.

## Requirements

-   **PHP**: ^7.3 or ^8.0
-   **Database**: MySQL or compatible
    -   Database name: `shipments`

## Installation

Follow these steps to get your development environment set up:

1. **Clone the Repository**

    Start by cloning the repository from GitHub:

    ```bash
    git clone https://github.com/yourusername/shipments.git
    cd shipments
    ```

2. **Install Dependencies**

    This project uses Composer to manage PHP dependencies. Ensure Composer is installed on your system. You can install it from getcomposer.org.

    Install the project dependencies:
    composer install

3. **Set Up Environment Configuration**

    Copy the example environment configuration file and modify it to include your database settings:
    cp .env.example .env

    Open the .env file and set your database connection details:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=shipments
    DB_USERNAME=root
    DB_PASSWORD=

4. **Create and Migrate the Database**

    Use Artisan to create the database tables. This assumes you have already set up your database:
    php artisan migrate

5. **Start the Development Server**

    Launch the development server to view and test the application:
    php artisan serve

    Your application will be accessible at http://localhost:8000.
