# Crypto Price Tracker


Crypto Price Tracker is a web application that displays the average prices of the top 10 cryptocurrencies for the day, yesterday, the week, month, and year.

## Requirements
- PHP 7.4 or later
- MySQL 5.7 or later
- Composer

## Installation

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

## Usage
To update the cryptocurrency prices, you need to set up a cron job to run the
```
/update_prices
```
route at regular intervals this depends on your deployment environment. Or just visit the route manually to get the initial data.
