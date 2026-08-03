# Laravel Accounting App

A feature-rich, self-hosted accounting and financial management web application built with **Laravel**, **Livewire**, and **Tailwind CSS**.

---

## 🌟 Features

- **Invoicing & Billing**: Generate customized invoices and track client payment statuses.
- **Expense Tracking**: Easily log operational costs and monitor daily spending.
- **Client & Vendor Management**: Maintain unified contact records for seamless transaction history.
- **Financial Analytics**: Real-time summaries of revenue, cash flow, and financial reports.

---

## 🚀 Quick Start (Local Setup)

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & npm
- MySQL / MariaDB

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/shakyamtech/laravel-accounting-app.git
   cd laravel-accounting-app
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Update your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) in `.env`.*

4. **Database Setup**
   ```bash
   php artisan migrate
   ```

5. **Run Local Server**
   ```bash
   php artisan serve --port=8002
   ```
   Open `http://localhost:8002/auth/login` in your browser.

---

## 🛠 Tech Stack

- **Backend**: PHP 8.1+ / Laravel Framework
- **Frontend**: Blade, Livewire, Tailwind CSS
- **Database**: MySQL

---

## 📄 License

Open-source project released under the [BSL License](LICENSE.txt).
