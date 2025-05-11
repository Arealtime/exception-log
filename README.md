# Laravel Modular Exception Logger 🧱⚠️

A Laravel package for generating clean, modular architecture **with built-in exception logging**. This tool helps you easily scaffold new modules and capture detailed exception logs into your database — perfect for scalable, well-organized applications.

## Features 🚀

- Built-in exception logger that stores errors in the database.
- Designed for clean, modular, and maintainable architecture.
- Easy integration with existing Laravel applications.
- Stores detailed exception data including message, trace, user info, request info, and more.

## Installation 📦

### Step 1: Add the local package

In your `composer.json`, add this:

```json
"repositories": [
    {
        "type": "path",
        "url": "packages/Arealtime/ExceptionLogger"
    }
],
"require": {
    "arealtime/exception-logger": "*"
}
```
### Step 2: Run the migration

```json
php artisan arealtime:exception-log migrate
```