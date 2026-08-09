# Laravel Accounting App

An open-source, self-hosted accounting and financial management platform built with Laravel, Livewire, and Tailwind CSS.

## Features

- **Invoicing & Billing**: Create invoices and manage client payment status
- **Expense Tracking**: Track operational costs and daily expenses
- **Client & Vendor Management**: Maintain contact records and transaction histories
- **Financial Analytics**: Reports for cash flow, revenue summaries, and expense tracking

## Tech Stack

- **Backend**: PHP (Laravel Framework)
- **Frontend**: Livewire, Blade, Tailwind CSS
- **Database**: MySQL / MariaDB

## Local Setup

### Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js & npm
- MySQL / MariaDB

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/shakyamtech/laravel-accounting-system.git
   cd laravel-accounting-system
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install && npm run build
   ```

3. Environment configuration:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Configure your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) in `.env`.

4. Database setup:
   ```bash
   php artisan migrate
   ```

5. Run development server:
   ```bash
   php artisan serve --port=8002
   ```

Access the app at [http://localhost:8002/auth/login](http://localhost:8002/auth/login).

## License

This project is released under the [BSL License](LICENSE.txt).

