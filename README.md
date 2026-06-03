# SalonBalance

> Salon management web application for tracking customers and treatments.  
> Built with Laravel 13, PHP 8.3, and Pest for testing.

---

## Features

- **Customer management** — create, view, edit and delete customer records (name, phone, address)
- **Treatment management** — log treatments per customer with name, price and version tracking
- **Full CRUD** — blade-based UI for all resources
- **Validated forms** — server-side validation on all inputs
- **Tested** — Pest feature tests for customers and treatments

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 13 |
| Language | PHP 8.3 |
| Frontend | Blade + Vite |
| Database | SQLite (local) |
| Testing | Pest 4 |
| Code style | Laravel Pint |

---

## Requirements

- PHP 8.3+
- Composer
- Node.js 18+
- npm

---

## Installation

```bash
# Clone the repository
git clone https://github.com/your-username/SalonBalance.git
cd SalonBalance

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Create the SQLite database and run migrations
touch database/database.sqlite
php artisan migrate

# Build frontend assets
npm run build
```

---

## Development

Start all services in one command:

```bash
composer dev
```

This starts:
- Laravel dev server (`php artisan serve`)
- Queue worker
- Log watcher (Pail)
- Vite HMR (`npm run dev`)

Or start individually:

```bash
php artisan serve    # http://localhost:8000
npm run dev          # Vite HMR
```

---

## Running Tests

```bash
composer test
# or
php artisan test
# or
./vendor/bin/pest
```

Tests cover:
- `CustomersTest` — index, create, store, show, edit, update, destroy
- `TreatmentsTest` — index, create, store, show, edit, update, destroy

---

## Project Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── CustomersController.php   # Full resource CRUD
│       └── TreatmentsController.php  # Full resource CRUD
├── Models/
│   ├── Customer.php                  # name, telephone_number, street_address
│   └── Treatment.php                 # name, price, version, customer_id
resources/
└── views/
    ├── customers/                    # index, show, create, edit
    └── treatments/                   # index, show, create, edit
routes/
└── web.php                           # /customers (resource), /treatments
tests/
└── Feature/
    ├── CustomersTest.php
    └── TreatmentsTest.php
```

---

## License

Copyright (C) 2026 JvLeeuwen Development. All rights reserved.

This project is licensed under the [GNU Affero General Public License v3.0](LICENSE).  
You may view and fork this code, but commercial use requires a separate commercial license.  
Contact **JvLeeuwen Development** for commercial licensing inquiries.