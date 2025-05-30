# Product & Order Management System

## Project Overview

This project is a simple Product and Order Management system built with Laravel. It allows managing products, suppliers, customers, and orders with related items. The system features pagination, validation, caching, soft deletes, and database transactions to ensure data integrity.

---

## Features

-   Manage products and orders
-   Create, update, soft delete orders and products
-   Validation of inputs for reliability
-   Use of database transactions for critical operations
-   Caching for frequently accessed data like customers, products, and suppliers
-   Pagination for listing products and orders

---

## Tools & Technologies Used

-   Laravel Framework (PHP)
-   MySQL (or any supported database)
-   Blade templating engine
-   Tailwind CSS (for styling)
-   Eloquent ORM
-   Cache system (file, Redis, or database driver configurable)
-   Database transactions for atomic operations

---

## Installation & Setup

1. Clone the repository:

    ```bash
    git clone https://github.com/Khaled-Mardini/e-store
    cd e-store
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install && npm run dev
    ```

3. Configure your `.env` file with your database credentials.

4. Run migrations and seeders:

    ```bash
    php artisan migrate --seed
    ```

5. Start the development server:

    ```bash
    php artisan serve
    ```

6. Open your browser and navigate to `http://localhost:8000`.

---

## Database Schema

-   `suppliers`: Supplier information
-   `products`: Products with foreign key to suppliers
-   `customers`: Customer details
-   `orders`: Orders with foreign key to customers
-   `order_items`: Items within an order linked to products

---

## Caching

The project caches data that rarely changes, such as suppliers, customers, and products lists, for one hour (3600 seconds) using Laravel's Cache facade. This improves performance by reducing database queries on frequently accessed data.

---

## Transactions

Database transactions are used during the creation and update of orders to ensure atomicity — either all changes succeed, or none are applied if an error occurs.

---

## Soft Deletes and NotDeleted Scope

Instead of permanently deleting records, this project uses a soft delete mechanism by setting an `IsDeleted` boolean flag. This allows recovery of data if needed.

A global scope named `NotDeletedScope` is applied to models to automatically exclude records marked as deleted (`IsDeleted = true`) from all queries, ensuring only active records are retrieved unless explicitly requested.

---

## Routes

-   `/` — Home page
-   `/products` — Resource routes for managing products
-   `/orders` — Resource routes for managing orders

---
