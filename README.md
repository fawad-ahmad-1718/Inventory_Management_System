# Inventory Management System — Upgraded

A web-based inventory management system built with **Laravel 11**, **Bootstrap 5**, **MySQL**, and **jQuery/AJAX**.

---

## What Was Upgraded

### Critical Fixes
- `APP_DEBUG` / `APP_ENV` in `.env.example` set to safe production defaults
- Demo credentials on login page wrapped in `@if(app()->isLocal())` — hidden in production
- `AdminMiddleware` now redirects unauthorized users to `/dashboard` (not `/`)
- `DB::transaction()` added to stock-in and stock-out for data integrity
- `CACHE_STORE` changed from `database` to `file` (simpler setup, no extra migration needed)
- `QUEUE_CONNECTION` changed to `sync`

### New Features
- **User Management** — Admin can create, edit, and delete system users (required by spec)
  - Routes: `GET/POST /users`, `GET/PUT /users/{user}/edit`, `DELETE /users/{user}`
  - `UserController` + `UserRequest` with full validation
  - Views: `users/index.blade.php`, `users/create.blade.php`, `users/edit.blade.php`
  - Password show/toggle + live password match indicator
  - Self-delete protection (admin cannot delete their own account)
- **Users link** added to sidebar under Administration (admin only)
- **System Users** stat card added to dashboard (links to user management)
- **AJAX Live Stock Checker** on both Stock In and Stock Out forms
  - When a product is selected, a jQuery AJAX call fetches current stock
  - Stock Out form disables submit button if quantity exceeds available stock
  - Endpoint: `GET /api/product-stock/{product}`

### Performance Fixes
- `ReportController::stockSummary` — N+1 query fixed with eager loading
  - Was: 2 queries × number of products
  - Now: 2 total queries via `with(['stockTransactions'])`
- New migration adds 4 DB indexes on `stock_transactions` (product_id, type, date, composite)

---

## Default Login Credentials

| Role  | Email                    | Password  |
|-------|--------------------------|-----------|
| Admin | admin@inventory.com      | admin123  |
| Staff | staff@inventory.com      | staff123  |

---

## Installation

### Prerequisites
- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js 18+

### Steps

```bash
# 1. Extract and enter the project folder
cd inventory-system

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies (optional — for Vite asset compilation)
npm install

# 4. Set up environment
cp .env.example .env
php artisan key:generate

# 5. Edit .env — set your database credentials
DB_DATABASE=inventory_management
DB_USERNAME=root
DB_PASSWORD=your_password

# 6. Create the database
mysql -u root -p -e "CREATE DATABASE inventory_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 7. Run migrations and seed sample data
php artisan migrate --seed

# 8. Start the development server
php artisan serve
```

Visit: http://localhost:8000

---

## Deployment to Production (Shared Hosting / cPanel)

1. Upload all files **except** the `public/` folder to a directory outside `public_html/` (e.g., `laravel-app/`)
2. Upload contents of `public/` into `public_html/`
3. Edit `public_html/index.php` — update both paths:
   ```php
   require __DIR__.'/../laravel-app/vendor/autoload.php';
   $app = require_once __DIR__.'/../laravel-app/bootstrap/app.php';
   ```
4. Create MySQL database via cPanel. Update `.env` on the server.
5. Via SSH:
   ```bash
   cd ~/laravel-app
   composer install --no-dev --optimize-autoloader
   php artisan key:generate
   php artisan migrate --seed --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   chmod -R 755 storage bootstrap/cache
   ```
6. Set in `.env` for production:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```

---

## Database Schema

| Table               | Purpose                                  |
|---------------------|------------------------------------------|
| `users`             | User accounts with role (admin/staff)    |
| `categories`        | Product categories                       |
| `products`          | Products with SKU, unit, stock levels    |
| `suppliers`         | Supplier contact details                 |
| `stock_transactions`| Every stock movement (in/out)            |

---

## Role Permissions

| Feature                  | Admin | Staff |
|--------------------------|:-----:|:-----:|
| Dashboard                | ✓     | ✓     |
| Stock In / Stock Out     | ✓     | ✓     |
| Stock History            | ✓     | ✓     |
| Current Stock Report     | ✓     | ✓     |
| Stock Movement Report    | ✓     | ✓     |
| Stock Summary Report     | ✓     | ✓     |
| Product Management       | ✓     | ✗     |
| Supplier Management      | ✓     | ✗     |
| User Management          | ✓     | ✗     |
