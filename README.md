# Student Management System

A responsive PHP 8 and MySQL web application for administrators to manage student records with secure authentication and CRUD operations.

## Features

- Admin login and logout with PHP sessions
- Password hashing with `password_hash()` / `password_verify()`
- Dashboard with total student count and recent students
- Add, view, edit, and delete student records
- Search students by name, email, or student ID
- Server-side validation for required fields, email format, phone length, and duplicate student IDs
- Prepared PDO statements to reduce SQL injection risk
- Bootstrap 5 responsive interface

## Tech Stack

- PHP 8
- MySQL
- HTML5 / CSS3 / JavaScript
- Bootstrap 5
- XAMPP or any PHP/MySQL local stack

## Installation

### Docker Setup

Use this if you do not want to install PHP or MySQL on your PC.

1. Start the PHP web server and MySQL database:

   ```bash
   docker compose up --build
   ```

2. Open `http://localhost:8000` in your browser.

The MySQL container imports `database.sql` automatically the first time it starts. Database data is stored in the `mysql_data` Docker volume, so it will stay available after stopping the containers.

To stop the app:

```bash
docker compose down
```

To reset the database and re-import `database.sql`:

```bash
docker compose down -v
docker compose up --build
```

### Local PHP/MySQL Setup

1. Clone the repository.
2. Import `database.sql` into MySQL.
3. Update database credentials in `config/database.php` if your MySQL username or password differs from the defaults.
4. Place the project in your XAMPP `htdocs` directory or run it with PHP's built-in server:

   ```bash
   php -S localhost:8000
   ```

5. Open `http://localhost:8000` in your browser.

## Demo Login

```text
Username: admin
Password: admin123
```

## Folder Structure

```text
php-student-management-system
├── assets
│   ├── css
│   ├── images
│   └── js
├── config
│   └── database.php
├── includes
│   ├── auth.php
│   ├── footer.php
│   └── header.php
├── models
│   ├── Admin.php
│   └── Student.php
├── students
│   ├── _form.php
│   ├── add.php
│   ├── delete.php
│   ├── edit.php
│   ├── list.php
│   └── view.php
├── dashboard.php
├── database.sql
├── index.php
├── login.php
└── logout.php
```
