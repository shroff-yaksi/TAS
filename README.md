# TAS — The Auto Shoppers

> **Type:** Business Website · **Stack:** HTML, CSS, JavaScript, PHP · **Status:** Live / Active Development

TAS is the official website for **The Auto Shoppers**, a car servicing and detailing business. It includes a service calculator, contact form with email, a booking flow, and an admin panel — all built as a static PHP-powered site with a premium dark-mode UI.

---

## Pages

| Page | Description |
|------|-------------|
| `index.html` | Homepage — hero, promotions, services overview, app teaser |
| `service.html` | Full service catalogue |
| `calculator.html` | Interactive price estimator (8 services, ₹500 minimum) |
| `offers.html` | Current promotions and deals |
| `about.html` | Company story and team |
| `team.html` | Team profiles |
| `contact.html` | Contact form (PHP + PHPMailer SMTP) |
| `admin/` | Password-protected admin panel |

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Structure | HTML5 |
| Styling | CSS3 (custom dark mode, responsive) |
| Interactivity | Vanilla JavaScript, jQuery |
| Animations | WOW.js, Animate.css |
| Backend | PHP 8 |
| Email | PHPMailer (SMTP) with `mail()` fallback |
| Maps | Google Maps embed |
| Icons | Font Awesome |

---

## Features

- **Dark Mode** — default on, persisted via `localStorage`, toggle on desktop + mobile nav
- **Service Calculator** — 8 services, real-time quote, ₹500 minimum charge
- **Contact Form** — PHPMailer SMTP (credentials via env vars), fallback to native `mail()`
- **Responsive** — mobile-first, hamburger nav with overflow fix
- **Admin Panel** — booking and enquiry management

---

## Running Locally

```bash
cd TAS
php -S localhost:8000
# → http://localhost:8000
```

**PHPMailer (production):**
```bash
composer require phpmailer/phpmailer vlucas/phpdotenv
```
Set env vars: `SMTP_HOST`, `SMTP_USER`, `SMTP_PASS`, `SMTP_PORT`

---

*Business website for The Auto Shoppers — car servicing & detailing*
