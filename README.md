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

1. Replace the following values in the `env.example` file 
with you DB credentials:
```
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
```

2. Generate a `.env` file by running the following commands:

```
    cp .env.example .env
    php artisan key:generate
```
3. See [deploying Laravel applications.](https://laravel.com/docs/8.x/deployment#introduction)
