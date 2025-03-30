# Quick Gear - Project Documentation

## Overview

Quick Gear is a full-featured project that provides a robust platform for managing products, user authentication, shopping, and order management. This documentation outlines every aspect of the site to help new users get started and understand its inner workings.

## Getting Started

- **Server Requirements:** XAMPP (Apache, PHP, MySQL)
- **Installation Steps:**
  - Clone or download the repository into `c:\xampp\htdocs\quick-gear`
  - If applicable, run `composer install` from the project root
  - Configure your environment by editing `config.php` with your database and server settings

## Functionalities

- **User Authentication:**
  - Users can register, log in, and manage their profiles.
- **Product Catalog:**
  - View products with details such as price, description, and images.
  - Search and filter products by various attributes.
- **Shopping Cart:**
  - Add products to the cart, review items, and modify quantities.
- **Checkout Process:**
  - Secure checkout flow to place orders.
- **Order Management:**
  - Users can view their order history and details.
  - Administrative interface to manage orders.
- **Admin Panel:**
  - Manage products, orders, and user accounts with role-based permissions.
- **Responsive Design:**
  - The site is optimized for both desktop and mobile devices.

## Project Structure

- `index.php`: The main entry point for the site.
- `/assets`: Contains static files like CSS, JavaScript, and images.
- `/includes`: Reusable PHP components and functions.
- `config.php`: Configuration file for setting up environment variables.
- Other directories as needed for additional modules and features.

## Contributing

- Fork the repository and create a new branch for your feature or bug fix.
- Submit a pull request with a clear description of the changes.
- Follow the coding standards outlined in the documentation.

## Troubleshooting

- Check XAMPP's server logs for any errors.
- Verify correct file paths and permissions.
- Consult this documentation for setup and configuration details.

## Additional Instructions

### Operating This Documentation

- Navigate this README for step-by-step instructions on setup and maintenance.
- Use browser search or a table of contents (if available) to quickly jump to relevant sections.

### Creating the Database

- Open phpMyAdmin via XAMPP.
- Create a new database, for example: `quick_gear_db`.
- Import the SQL schema from `database/quick_gear_schema.sql` (if provided with the project).
- Update `config.php` with your database credentials.

### Folder Structure Guidelines

- Root Directory: c:\xampp\htdocs\quick-gear
  - `index.php`: Main entry point.
  - `/assets`: Static files such as CSS, JavaScript, and images.
  - `/includes`: Reusable PHP components.
  - `/database`: Contains SQL files (e.g., `quick_gear_schema.sql`).
  - `/admin`: Administrative interface and functionalities.
  - `/user`: User-specific interface and logic.
  - Additional folders for other project modules as necessary.

### How the Project Works

- The project uses a modular design:
  - Front controller (`index.php`) dispatches requests to various controllers.
  - Database interactions use PHP PDO for secure operations.
  - Session management and user authentication are implemented across the application.
  - Each folder contains domain-specific code for clear separation of concerns.
