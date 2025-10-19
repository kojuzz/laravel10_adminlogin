# Laravel 10 Admin Login Project Setup

Follow these steps to set up the project locally.

---

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

Use the following credentials to log in:

> username: jon
>
> password: 123123

