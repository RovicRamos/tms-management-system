<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Yes! The built-in terminal inside your GitHub Codespace is a fully functioning cloud terminal, and **you can absolutely run your Laravel server directly from it**.

In fact, running your server inside a Codespace is a great experience because GitHub will automatically detect it and securely give you a private web link to view your application.

---

### Step-by-step: How to run the server in Codespaces

Follow these quick commands inside your Codespace terminal:

#### 1. Start the Laravel development server

Type this command into the terminal and press Enter:

```bash
php artisan serve

```

#### 2. Open the application in your browser

Once you press enter, you will see a small pop-up notification in the bottom-right corner of your screen that says:

> **"An application is running on port 8000."**

* Click the green **"Open in Browser"** button in that pop-up.
* Alternatively, look for the **Ports** tab right next to your Terminal panel at the bottom, hover over port `8000`, and click the small globe icon (🌐) to open the page.

---

### ⚠️ One Important Check Before You Run It

Because you just transferred your files to a fresh cloud environment, you might need to make sure the environment dependencies are installed in the Codespace first.

If `php artisan serve` gives you an error, run these two setup commands in the terminal first, then try serving again:

```bash
# 1. Re-install packages for the Codespace environment
composer install --ignore-platform-reqs

# 2. Run your database migrations to ensure the tables exist in the cloud database
php artisan migrate

```

It looks like you want to organize the troubleshooting steps we just discussed into a clean, professional Markdown guide. This is perfect for keeping as a reference or sharing with your team!

---

# Laravel Configuration & Debugging Guide for GitHub Codespaces

If you encounter a **500 Internal Server Error** in a new or cloned Laravel environment, follow these steps to restore functionality.

## 1. Setup the Environment File

Since the `.env` file is ignored by Git, you must recreate it from the template provided in your repository.

```bash
# Create the .env file from the example template
cp .env.example .env

```

## 2. Generate Application Security Keys

Laravel requires an `APP_KEY` to encrypt sessions and cookies. Without this, the application will throw a `MissingAppKeyException`.

```bash
# Generate a unique key and inject it into your .env
php artisan key:generate

```

## 3. Clear Framework Caches

Sometimes Laravel "remembers" the old configuration (or lack thereof). Clear these caches to ensure the new `.env` settings are loaded.

```bash
# Clear configuration, route, and view caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

```

## 4. Architecture Overview: How it connects

To understand why these files are critical, visualize how the Laravel framework loads its environment:

* **`.env.example`**: Acts as the blueprint for your environment variables.
* **`.env`**: The active file containing your unique, secret keys and database credentials.
* **`config/` folder**: Reads these values into the application engine at runtime.

## 5. Troubleshooting 500 Errors

If you still see a **500 Error** after the steps above, enable "Debug Mode" to see the specific code error instead of a generic message:

1. Open your `.env` file.
2. Set `APP_DEBUG=true`.
3. Refresh your browser.
4. Check for **Database errors** or **Missing Class** exceptions in the stack trace.

---

**Does this document cover everything you need, or would you like me to add a section on how to configure your database connection settings next?**

Give `php artisan serve` a run in your Codespace terminal and let me know if your Training Management System successfully opens up in the browser link!
