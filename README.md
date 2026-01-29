# 🚀 Blog API

A robust, secure, and feature-rich RESTful API built with **Laravel 12**. This project includes complete user authentication, role-based access control, content management, and engagement systems.

---

## 🛠 Features

* **Authentication:** Secure auth via Laravel Sanctum (Bearer Tokens).
* **Verification:** Email verification system for enhanced security.
* **Authorization:** Multi-level access control (User -> Verified User -> Admin).
* **Content Management:** Full CRUD for Categories and Posts with image uploads.
* **Engagement:** Comment system and "Like" (toggle) functionality.
* **Analytics:** Automatic post view counting.
* **Developer Friendly:** Standardized JSON response format via `BaseController`.

---

## 📥 Installation

Follow these steps to set up the project locally:

### 1. Clone the repository
```bash
git clone https://github.com/yuldoshewuz/blog-api.git
cd blog-api

```

### 2. Install dependencies

```bash
composer install

```

### 3. Environment Setup

Create your `.env` file from the template:

```bash
cp .env.example .env

```

*Open `.env` and configure your database settings (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) and mail settings.*

### 4. Generate Application Key

```bash
php artisan key:generate

```

### 5. Database Migration & Seeding

Run migrations to create tables and seed initial data:

```bash
php artisan migrate --seed

```

### 6. Storage Link

Create a symbolic link to make uploaded images accessible from the web:

```bash
php artisan storage:link

```

---

## 🚀 Running the Project

Start the local development server:

```bash
php artisan serve

```

The API will be available at: `http://127.0.0.1:8000/api`

---

## 📖 API Documentation

The complete API documentation is integrated directly into the application. You can explore all endpoints, request parameters, and response formats here:

🔗 **[View API Documentation](https://blog.yuldoshew.uz/)**

or view your localhost: `http://127.0.0.1:8000`

---

## 🛠 Tech Stack

* **Framework:** Laravel 12
* **Auth:** Laravel Sanctum
* **Database:** MySQL / PostgreSQL
* **Storage:** Local / S3

---

## 👨‍💻 Developed By

**Fozilbek Yuldoshev**

* GitHub: [@yuldoshewuz](https://github.com/yuldoshewuz)
* Portfolio: [yuldoshew.uz](https://yuldoshew.uz)
