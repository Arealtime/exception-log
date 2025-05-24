# 🛠️ Exception Logger For Laravel

A Laravel package for generating clean, modular architecture **with built-in exception logging**. This tool helps you easily scaffold new modules and capture detailed exception logs into your database — perfect for scalable, well-organized applications.


> 🔗 Repository: [github.com/Arealtime/exception-log](https://github.com/Arealtime/exception-log)

---

## ✨ Features

- ✅ Built-in exception logger that stores errors in the database.
- ✅ Designed for clean, modular, and maintainable architecture.
- ✅ Easy integration with existing Laravel applications.
- ✅ Stores detailed exception data including message, trace, user info, request info, and more.

---

## 🚀 Installation

In your Laravel project's `composer.json`, add the following:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/Arealtime/exception-log"
    }
]
"require": {
    "arealtime/exception-log": "*"
}
```

Then run:

```bash
composer update
```
```bash
php artisan arealtime:exception-log migrate
```

---

## 📋 Usage

After setting up the application, go to the following URL to view the error logs with an easy search feature: **`<your-project-url>/arealtime/exception-logs`**


---

## 👤 Author

**Arash Taghavi**  
📧 arash.taghavi69@gmail.com  
🔗 [GitHub: arashtaghavi](https://github.com/arashtaghavi)

---

## 📄 License

MIT © Arealtime

---

## ⭐️ Contribute & Support

- 🌟 Star the repository
- 🛠️ Fork and improve the package
- 🐛 Submit issues or feature requests

---

> _Built with ❤️ to help you scale Laravel the modular way._