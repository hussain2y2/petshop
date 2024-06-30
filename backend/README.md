# Pet Shop API

## Introduction
The Pet Shop API is a backend service built with Laravel that provides CRUD operations for users and products. It includes authentication using JSON Web Tokens (JWT) for secure access to protected routes. Additionally, it offers password reset functionalities via email.

## Requirements
- PHP 8.3
- Composer
- MySQL
- Node.js (for frontend development, if applicable)

## Installation

### Step 1: Clone the repository
```bash
git clone https://github.com/hussain2y2/petshop.git
cd petshop/backend
```

### Step 2: Install dependencies
```bash
composer install
```

### Step 3: Set up environment variables
Copy the .env.example file to .env and update the necessary environment variables:
```bash
cp .env.example .env
```

Update your .env file with your database and mail configuration:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=petshop
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
JWT_SECRET=your_secret_key
L5_SWAGGER_GENERATE_ALWAYS=
```

### Step 4: Generate application key
```bash
php artisan key:generate
```

### Step 5: Run migrations and seeders
```bash
php artisan migrate --seed
```

### Step 6: Serve the application
```bash
php artisan serve
```

## API Documentation

Checkout the swagger documentation for the APIs.

