# Crypto Price Tracker


Crypto Price Tracker is a web application that displays the average prices of the top 10 cryptocurrencies for the day, yesterday, the week, month, and year.

## Requirements
- PHP 7.4 or later
- MySQL 5.7 or later
- laravel 10.0 or later
- Composer


# Installation

## Laravel

The Laravel framework has a few system requirements. All of these requirements are satisfied by the [Laravel Homestead](https://laravel.com/docs/7.x/homestead) virtual machine, so it's highly recommended that you use Homestead as your local Laravel development environment.

However, if you are not using Homestead, you will need to make sure your server meets the following requirements:

- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

### Installing Laravel
Laravel utilizes [Composer](https://getcomposer.org/) to manage its dependencies. So, before using Laravel, make sure you have Composer installed on your machine.

First, download the Laravel installer using Composer:
``` bash
composer global require laravel/installer
```
Make sure to place Composer's system-wide vendor bin directory in your `$PATH` so the laravel executable can be located by your system. This directory exists in different locations based on your operating system; however, some common locations include:

- macOS: `$HOME/.composer/vendor/bin`
- Windows: `%USERPROFILE%\AppData\Roaming\Composer\vendor\bin`
- GNU / Linux Distributions: `$HOME/.config/composer/vendor/bin or $HOME/.composer/vendor/bin`


Clone the repository to your local machine:
```bash
git clone https://github.com/Kid-jnr/crypto-tracker.git
```

Install the required dependencies using Composer:
```bash
cd crypto-tracker
composer install
```
Configure the MySQL database settings in the .env file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crypto_price_tracker
DB_USERNAME=root
DB_PASSWORD=
```

Run the database migrations:

```sh
php artisan migrate
```

Start the application by running the serve command
```bash
php artisan serve
```

## Usage
Once the application has been started, you can access the homepage by visiting the `/` route.
Example `http://127.0.0.1:8000/`

To update the cryptocurrency prices, you need to set up a cron job to run the
```
/update_prices
```
Example: `http://127.0.0.1:8000/update_prices`

route at regular intervals this depends on your deployment environment. Or just visit the route manually to get the initial data.
