# SimpleAttendance 📋

<!-- portfolio:desc -->
**SimpleAttendance** is a web-based attendance system built with the **Laravel** framework. It provides a simple and efficient way to manage employee presence, replacing manual paper logs with a streamlined digital solution.
<!-- portfolio:desc:end -->

---

## 📌 Project Description
This application focuses on the core essentials of attendance tracking. It allows users to record their daily check-ins and check-outs, while providing administrators with a clear overview of attendance data. It is designed to be lightweight, easy to deploy, and user-friendly.

## ✨ Key Features
* **User Authentication:** Secure login system for employees and admins.
* **Check-In/Check-Out:** Simple interface to log work hours.
* **Attendance History:** Users can view their own attendance records.
* **Admin Dashboard:** Centralized view to monitor daily attendance.
* **Report Generation:** Basic reporting features for monthly attendance.

## 🛠️ Tech Stack
* **Framework:** Laravel (PHP)
* **Database:** MySQL
* **Frontend:** Blade Templates, Bootstrap/Tailwind (adjust based on your actual UI)

---

## 🚀 Installation Guide

Since this project is built with Laravel, please follow these steps carefully to set it up on your local machine.

### Prerequisites
Ensure you have the following installed:
* [PHP](https://www.php.net/) (Version 8.x recommended)
* [Composer](https://getcomposer.org/)
* [MySQL](https://www.mysql.com/)
* [Node.js & NPM](https://nodejs.org/) (Optional, if using Vite/Mix)

### Step-by-Step Setup

1.  **Clone the Repository**
    ```bash
    git clone [https://github.com/dachi01-afk/Presensi.git](https://github.com/dachi01-afk/Presensi.git)
    ```

2.  **Navigate to Project Directory**
    ```bash
    cd Presensi
    ```

3.  **Install PHP Dependencies**
    This will install all the libraries required by Laravel.
    ```bash
    composer install
    ```

4.  **Install Frontend Dependencies (Optional)**
    If the project uses npm for asset compilation:
    ```bash
    npm install
    npm run build
    ```

5.  **Environment Configuration**
    Duplicate the example configuration file.
    ```bash
    cp .env.example .env
    ```

6.  **Generate Application Key**
    This command generates the encryption key required by Laravel.
    ```bash
    php artisan key:generate
    ```

7.  **Configure Database**
    * Create a new empty database in your MySQL (e.g., named `presensi_db`).
    * Open the `.env` file and update your database credentials:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=presensi_db
        DB_USERNAME=root
        DB_PASSWORD=
        ```

8.  **Run Migrations**
    Create the necessary tables in your database.
    ```bash
    php artisan migrate
    ```

    *(Optional: If you have dummy data, run seeders)*
    ```bash
    php artisan db:seed
    ```

9.  **Run the Application**
    Start the local development server.
    ```bash
    php artisan serve
    ```

    The application will be accessible at: `http://127.0.0.1:8000`

## 👤 Usage
1.  Open your browser and go to `http://127.0.0.1:8000`.
2.  **For Admin:** Login using the admin credentials (check `DatabaseSeeder.php` if you don't know them).
3.  **For Users:** Register a new account (if enabled) or use provided credentials to start logging attendance.

---
**Developed by [Dachi](https://github.com/dachi01-afk)**
