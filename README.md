# Laravel 10 Admin Login Project Setup

This is a Laravel 10 admin login project that includes:

* Admin User Registration, and Login, 

* Two-Step Verification, 

* Forgot Password, and Reset Password Features.

* Admin Profile Management and Change Password Features.

---

Follow these steps to set up the project locally.

## 1. Clone the repository

```bash
git clone https://github.com/kojuzz/laravel10_adminlogin.git
```
> Change directory to the project folder
```bash
cd laravel10_adminlogin/
```

## 2. Install dependencies

```bash
npm install
composer install
```

## 3. Setup environment

> Rename `.env.example` to `.env`

Then Edit `.env` and change the database connection to SQLite:

**.env**

>Change
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

> to
```bash
DB_CONNECTION=sqlite
```
```bash
# Delete or comment these lines
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

## 4. Generate application key

```bash
php artisan key:generate
```

## 5. Run migration and seeder

```bash
php artisan migrate --seed
```

## 6. Start development server

```bash
php artisan serve
```

## 7. Access the application

Open your browser and navigate to http://localhost:8000

Register as a user or use the following credentials to log in:

> username: jon
>
> password: 123123

For local testing two-step verification, use `123123` as OTP Code

---

# Setup Mail

Follow these steps to set up mail

## 1. Edit .env file

Edit `.env` file for mail configuration

> Change

```bash
APP_NAME=laravel
APP_ENV=local

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

> to

```bash
APP_NAME="Admin Panel"
APP_ENV=production

# Add Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your_mail_host
MAIL_PORT=your_mail_port
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 2. Restart development server

Stop development server by pressing `Ctrl + C`

> Clear cache and config
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

> Start development server
```bash
php artisan serve
```

You can now test the mail functionality by two-step verification, forgot password, and reset password features.