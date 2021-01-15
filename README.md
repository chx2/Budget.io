<p align="center">
  <img src="https://github.com/chx2/Budget.io/blob/master/public/img/logo.png" alt="Budget.io Logo">
</p>

## About Budget.io

Budget.io is a web-based budget application written in the 
[Laravel](https://laravel.com/) framework, utilizing the 
[Inertia.js](https://inertiajs.com/) driver to behave as 
a single-page application while using Laravel's built-in 
authentication and routing.

* **Manage Your Budget** - Create monthly budgets to 
track income, spending, and changes between your budget 
periods.

* **Create Reports** - Print off monthly reports, income, 
and expense statements separately.

* **Gather Insights** - Learn about trends over time when 
creating budgets.  Learn through various charts about 
tips for improving areas of your budget and suggested 
improvements.

## Installing Budget.io
1. Create the intial project by running the following command via [Composer](https://getcomposer.org/)
```
composer create-project chx2/budget.io
```

2. Install dependencies via Composer & NPM:

```
composer install
npm install
npm run production
```

3. Replace the following values in the `env.example` file 
with your DB credentials:
```
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

4. Generate a `.env` file & run database migrations by running the following commands:

```
cp .env.example .env
php artisan key:generate
php artisan migrate
```

5. See [deploying Laravel applications.](https://laravel.com/docs/8.x/deployment#introduction)
