# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

TAS (The Auto Shoppers) is a multi-page PHP website for a car servicing and detailing business. It uses traditional server-rendered HTML with a PHP/SQLite backend — no build tools or package managers.

## Development Server

```bash
php -S localhost:8000
# Visit http://localhost:8000
```

No npm install or composer install needed. All dependencies are vendored in `lib/` or included directly.

## Architecture

### Frontend
- 9 HTML pages: `index.html`, `service.html`, `calculator.html`, `offers.html`, `about.html`, `team.html`, `contact.html`, `booking.html`, `updates.html`
- `js/main.js` — centralizes all page logic: WOW.js animation init, dark mode toggle, service calculator, form submissions via AJAX
- `js/cookies.js` — cookie consent banner logic
- `js/login.js` — admin login form handling
- Dark mode is **on by default**, toggled via `body.dark-mode` class, persisted in `localStorage`. CSS custom properties are inverted (`--white: #0c0c0e` in dark mode)
- `6_tas/` — an older iteration of the project; ignore it, work only in the root-level files

### Backend (PHP)
- **`php/db.php`** — Singleton `Database` class wrapping SQLite PDO. Auto-creates all 5 tables on first connection: `bookings`, `contacts`, `newsletter`, `rate_limits`, `users`
- **`php/utils.php`** — Input sanitization, CSRF tokens, IP-based rate limiting, ID generation (`TAS` + timestamp + random), and `sendEmail()` (tries PHPMailer SMTP if available, falls back to native `mail()`)
- **`php/config.php`** — Central config loader; reads SMTP env vars: `SMTP_HOST`, `SMTP_USER`, `SMTP_PASS`, `SMTP_PORT`
- AJAX handlers: `php/contact.php` (5/hour), `php/booking.php` (3/hour), `php/newsletter.php`, `php/faq.php` — all rate-limited by IP

### Admin Panel (`admin/`)
- Session-based auth via `admin/auth.php` (include at top of every protected page)
- Login at `/admin/login.php`, dashboard at `/admin/index.php`
- Default credentials: `admin` / `admin123`

### Service Calculator Logic
- 8 services x 4 car segments (Budget 1.0x, Mid 1.3x, Premium 1.7x, Luxury 2.0x)
- Minimum charge enforced: `max(total x multiplier, 500)` in INR
- All calculator logic lives in `js/main.js`

## Key Patterns

- **Security**: All POST inputs go through `sanitizeInput()` in `utils.php`. CSRF tokens are generated per-session and verified on each form submission. Passwords use `password_hash()`/`password_verify()`.
- **Email**: PHPMailer is NOT vendored in this repo. `sendEmail()` falls back to native `mail()` unless PHPMailer is installed separately. HTML email templates use red `#E31E24` header branding.
- **Error logging**: PHP errors and application exceptions write to `data/error.log`.
- **Database path**: `data/tas.db` (SQLite file, gitignored).

## Linting

WebHint is configured via `.hintrc` (accessibility preset). Run with:
```bash
npx hint http://localhost:8000
```
