# TAS - Travel Agency System

A modern, responsive travel agency website built with Bootstrap, jQuery, and PHP.

## Features

- 🏠 **Homepage**: Attractive carousel and service showcase
- 📋 **Services**: Display of travel packages and offerings
- 👥 **Team**: Team member profiles
- 📞 **Contact**: Contact form with PHP backend
- 📅 **Booking**: Travel booking system
- 💬 **FAQ**: Interactive FAQ section with DataTables
- 📰 **Newsletter**: Email subscription system

## Tech Stack

- **Frontend**: HTML5, CSS3, Bootstrap 5, SCSS
- **JavaScript**: jQuery, Owl Carousel, WOW.js animations
- **Backend**: PHP
- **Libraries**:
  - Bootstrap 5
  - Owl Carousel
  - Tempus Dominus (Date/Time picker)
  - DataTables
  - CounterUp
  - Animate.css

## Project Structure

```
TAS/
├── css/                  # Compiled CSS
│   ├── bootstrap.min.css
│   └── style.css
├── scss/                 # SCSS source files
│   └── bootstrap/
├── js/                   # JavaScript files
│   ├── main.js
│   ├── login.js
│   └── cookies.js
├── img/                  # Images and assets
├── lib/                  # Third-party libraries
├── php/                  # PHP backend scripts
│   └── faq.php
└── phptut/              # PHP tutorials/examples
    ├── booking.php
    └── newsletter.php
```

## Installation

1. Clone the repository:
```bash
git clone <your-repo-url>
cd TAS
```

2. Set up a local web server (Apache/Nginx) or use PHP's built-in server:
```bash
php -S localhost:8000
```

3. Open your browser and navigate to:
```
http://localhost:8000
```

## Configuration

### PHP Backend
- Update database credentials in PHP files if using a database
- Configure SMTP settings for newsletter/contact forms

### Customization
- Edit SCSS files in `/scss` directory
- Compile SCSS to CSS using your preferred tool
- Modify images in `/img` directory
- Update content in HTML/PHP files

## Pages

The website includes the following pages (referenced in `.docx` files):
- `index` - Homepage
- `about` - About Us
- `service` - Services
- `team` - Our Team
- `contact` - Contact Us
- `booking` - Book a Trip
- `offers` - Special Offers
- `updates` - Latest Updates

## Development

### Compile SCSS
```bash
# Install sass compiler
npm install -g sass

# Compile SCSS
sass scss/bootstrap.scss css/bootstrap.css
```

### Browser Support
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

MIT License

## Author

Yaksi Shroff

## Notes

This project appears to be a learning/portfolio project for web development with Bootstrap and PHP.
