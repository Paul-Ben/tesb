# AGENTS.md - TESB School Management System

## Tech Stack
- Laravel 10 (PHP 8.1+)
- Vite + TailwindCSS + AlpineJS
- Breeze (authentication), Sanctum (API)
- Maatwebsite/Excel for result imports
- PHPUnit for testing

## Key Commands

```bash
# Setup
composer install
npm install
cp .env.example .env
php artisan key:generate

# Development
npm run dev          # Start Vite dev server
php artisan serve    # Start Laravel server

# Production build
npm run build

# Testing
php artisan test     # Run all tests (or vendor/bin/phpunit)

# Code style (Laravel Pint)
./vendor/bin/pint    # Auto-fix style issues
```

## Architecture

- **Roles**: Super Admin, Admin, Teacher, User (guardian/student)
- **Prefixes**: `/superadmin`, `/admin`, `/teacher`, `/user`
- **Key Controllers**: `AdminActions`, `TeacherController`, `ResultController`, `ResultImportController`
- **Import**: Bulk result upload via `ResultImportController` (CSV/Excel)

## Important Details

- **Scoring Rule**: Subject is unscored when `CA=0 AND Exam=0`. Unscored subjects excluded from average and position calculation.
- **Class Categories**: Kindergarten (CA50/Exam50), Primary (CA40/Exam60), JSS (CA60/Exam40), SSS (CA30/Exam70)
- **Deployment**: Push to `main` triggers FTP deploy via GitHub Actions (requires secrets: ENV, SERVER, USERNAME, PASSWORD)

## Test Configuration
- Uses array drivers for mail, cache, queue, session (in phpunit.xml)
- BCRYPT_ROUNDS set to 4 for faster tests
- Two suites: Unit (`tests/Unit`) and Feature (`tests/Feature`)