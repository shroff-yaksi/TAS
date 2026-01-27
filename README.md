# TAS - The Auto Shoppers

A professional car service and repair management system built with Bootstrap 5, PHP, and SQLite.

## Features

- 🏠 **Homepage**: Modern landing page with service carousel, premium dark UI, and mobile app preview.
- 🌓 **Premium Dark Mode**: Sophisticated dark theme with glassmorphism and neon accents, persistent via LocalStorage.
- 🧮 **Service Calculator**: Interactive price estimation tool for customers.
- 📅 **Smart Booking**: Online appointment scheduling with SQLite persistence.
- 💼 **Admin Dashboard**: Full-featured management suite for bookings, messages, and subscribers.
- 👥 **Team**: Profile showcase of expert technicians.
- 📞 **Contact**: Integrated contact form and WhatsApp floating button.
- 📊 **Database**: Persistent storage using SQLite 3.

## Tech Stack

- **Frontend**: HTML5, CSS3 (Custom Variables), Bootstrap 5, Glassmorphism CSS.
- **JavaScript**: jQuery (AJAX), Owl Carousel, WOW.js, Animate.css.
- **Backend**: PHP 8.x (Session-based Auth).
- **Database**: SQLite 3.

## Project Structure

```
TAS/
├── css/                  # Stylesheets (Bootstrap & Custom)
├── scss/                 # SCSS source files
├── js/                   # JavaScript logic
├── img/                  # High-quality automotive assets
├── lib/                  # Third-party libraries (Owl, WoW, etc.)
├── php/                  # PHP backend logic & API handlers
├── data/                 # Database storage (tas.db)
└── index.html            # Main entry point
```

## Setup & Installation

1. **Clone & Navigate**:
   ```bash
   cd TAS
   ```

2. **Database Initialization**:
   The system uses an auto-initializing SQLite database. Ensure the `data/` directory is writable.

3. **Run Locally**:
   Using PHP's built-in server:
   ```bash
   php -S localhost:8000
   ```

4. **Access**:
   Open `http://localhost:8000` in your browser.

## License

Developed by Yaksi Shroff
