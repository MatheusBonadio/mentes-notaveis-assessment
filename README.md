# Mentes Notáveis Assessment

<p>
    <img alt='License' src='https://img.shields.io/badge/license-mit-1C1E26?style=for-the-badge&labelColor=1C1E26&color=007fe3' />
    <img alt='version' src='https://img.shields.io/badge/version-1.0-1C1E26?style=for-the-badge&labelColor=1C1E26&color=007fe3' />
</p>

## 💻 Project
The project is divided into three parts:
- **Back-end 1**: An api of users with address using **Laravel** located in `/back-end/laravel`;
- **Back-end 2**: An api of users with address using **Vanilla PHP** located in `/back-end/vanilla-php`;
- **Front-end**: An object-oriented stove located in `/front-end`.

## 🛠️ Technologies

- [PHP](https://www.php.net/) (8.2.12)
- [Laravel](https://laravel.com/docs/10.x) (10.48.7)
- [PhpMyAdmin](https://www.phpmyadmin.net/) (5.2.1)
- [MariaDB](https://mariadb.org/) (10.4.32)
- [Swagger](https://swagger.io/) (3.0.0)
- [Composer](https://getcomposer.org/) (2.1.9)
- [JavaScript](https://developer.mozilla.org/pt-BR/docs/Web/JavaScript) (ES6)


## 📋 Requirements to back-end run

It is recommended to run the Laravel project first due to migrations.

```sql
CREATE DATABASE mentes_notaveis;
```

```bash
# Cloning the repository and accessing the directory
git clone git@github.com:MatheusBonadio/mentes-notaveis-assessment.git && cd mentes-notaveis-assessment
```

## ⚙️ Back-end 1 execution (Laravel)

```bash
# Accessing the back-end directory
cd back-end/laravel

# Installing dependencies
composer install

# Copying the .env.example file to .env
cp .env.example .env

# Generating the application key
php artisan key:generate

# Generating database migration and seeds
php artisan migrate:fresh --seed

# Running the application
php artisan serve
```

## ⚙️ Back-end 2 execution (Vanilla PHP)

```bash
# Accessing the back-end directory
cd back-end/vanilla-php

# Installing dependencies
composer install

# Copying the config.example.php file to config.php
cp config.example.php config.php
```

## 🖌️ Front-end execution

```bash
# Accessing the front-end directory
cd front-end

# Open the index.html file with any browser 🚀
```

## 📄 License

MIT © Matheus Bonadio