# TAS Modularization Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Eliminate HTML duplication across 9 pages by extracting PHP partials and consolidating inline scripts into JS files — zero UI/functionality change.

**Architecture:** Rename `.html` → `.php`, extract navbar/footer/head/whatsapp into `partials/`, move newsletter AJAX into `js/main.js`, extract page-specific AJAX into `js/booking.js`, `js/contact.js`, `js/calculator.js`.

**Tech Stack:** PHP (no Composer), jQuery, vanilla HTML/CSS, SQLite

---

## Task 1: Create `partials/` directory and `partials/head.php`

**Files:**
- Create: `partials/head.php`

**Step 1: Create the file**

```php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title ?? 'The Auto Shoppers') ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?= htmlspecialchars($keywords ?? 'car service surat, auto repair adajan') ?>" name="keywords">
    <meta content="<?= htmlspecialchars($description ?? 'The Auto Shoppers - Surat\'s premier multi-brand car service workshop.') ?>" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
```

**Step 2: Verify file exists**

```bash
ls partials/head.php
```

---

## Task 2: Create `partials/navbar.php`

**Files:**
- Create: `partials/navbar.php`

**Step 1: Create the file**

Copy the navbar HTML from any existing page exactly. Use `basename($_SERVER['PHP_SELF'])` for automatic active-link detection. Replace all `.html` hrefs with `.php`:

```php
<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-4 px-xl-5">
            <h2 class="m-0 text-danger d-flex align-items-center gap-1"
                style="font-family: 'Times New Roman', Times, serif; font-weight: 700; letter-spacing: 0.5px;">
                <img src="img/tas_logo_light_theme.png" alt="TAS Logo" class="logo-light" style="max-height: 40px;">
                <img src="img/tas_logo_dark_theme.png" alt="TAS Logo" class="logo-dark" style="max-height: 40px;">
                THE AUTO SHOPPERS
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?= in_array($currentPage, ['about.php','team.php']) ? 'active' : '' ?>" data-bs-toggle="dropdown">About</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="about.php" class="dropdown-item">About Us</a>
                        <a href="team.php" class="dropdown-item">Our Team</a>
                    </div>
                </div>
                <a href="service.php" class="nav-item nav-link <?= $currentPage === 'service.php' ? 'active' : '' ?>">Services</a>
                <a href="offers.php" class="nav-item nav-link <?= $currentPage === 'offers.php' ? 'active' : '' ?>">Offers</a>
                <a href="calculator.php" class="nav-item nav-link <?= $currentPage === 'calculator.php' ? 'active' : '' ?>">Calculator</a>
                <a href="contact.php" class="nav-item nav-link <?= $currentPage === 'contact.php' ? 'active' : '' ?>">Contact</a>
                <!-- Mobile-only items -->
                <div class="d-lg-none mt-3 mb-2 px-2">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted">Dark Mode</span>
                        <button id="dark-mode-toggle-mobile" class="btn btn-sm btn-outline-secondary rounded-circle"
                            style="width: 40px; height: 40px; padding: 0;">
                            <i class="fas fa-moon"></i>
                        </button>
                    </div>
                    <a href="booking.php"
                        class="btn btn-danger w-100 rounded-0 shadow-sm hover-lift d-flex align-items-center justify-content-center py-3">Book
                        Service<i class="fa fa-arrow-right ms-2 btn-icon-animate"></i></a>
                </div>
            </div>
            <div class="d-none d-lg-flex align-items-center me-4">
                <button id="dark-mode-toggle" class="btn btn-sm btn-outline-secondary rounded-circle"
                    style="width: 40px; height: 40px; padding: 0;">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
        <a href="booking.php"
            class="btn btn-danger rounded-0 px-lg-5 shadow-sm d-none d-lg-flex align-items-center">Book
            Service<i class="fa fa-arrow-right ms-3 btn-icon-animate"></i></a>
    </nav>
    <!-- Navbar End -->
```

**Step 2: Verify file exists**

```bash
ls partials/navbar.php
```

---

## Task 3: Create `partials/footer.php`

**Files:**
- Create: `partials/footer.php`

**Step 1: Create the file**

Copy the footer HTML from `index.html` exactly (lines 342–405), update all `.html` links to `.php`, then append JS library tags and `js/main.js`:

```php
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Address</h4>
                    <p class="mb-2"><a href="https://maps.app.goo.gl/8qUdaxQss6PjkeA48" target="_blank"
                            class="text-light text-decoration-none"><i class="fa fa-map-marker-alt me-3"></i>5QXH+JQW,
                            Adajan Gam, Surat, Gujarat 394510</a></p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 99798 65551</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>theautoshoppers.in@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/theautoshoppers.in/"
                            target="_blank"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social"
                            href="https://www.facebook.com/p/The-Auto-shopperrs-100090731028436/" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://wa.me/919979865551" target="_blank"><i
                                class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Opening Hours</h4>
                    <h6 class="text-light">Monday - Saturday:</h6>
                    <p class="mb-4">09.30 AM - 08.00 PM</p>
                    <h6 class="text-light">Sunday:</h6>
                    <p class="mb-0">Closed</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Services</h4>
                    <a class="btn btn-link d-block" href="service.php">Diagnostic Test</a>
                    <a class="btn btn-link d-block" href="service.php">Engine Repair</a>
                    <a class="btn btn-link d-block" href="service.php">Brake Service</a>
                    <a class="btn btn-link d-block" href="service.php">Oil Change</a>
                    <a class="btn btn-link d-block" href="service.php">A/C Service</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <p>Subscribe for exclusive updates and seasonal offers.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <form id="newsletterForm">
                            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="email"
                                placeholder="Your email" required>
                            <button type="submit"
                                class="btn btn-danger py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </form>
                    </div>
                    <div id="newsletterMessage" class="mt-2" style="font-size: 14px;"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; The Auto Shoppers, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed By Connect +
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-danger btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
```

**Step 2: Verify file exists**

```bash
ls partials/footer.php
```

---

## Task 4: Create `partials/whatsapp.php`

**Files:**
- Create: `partials/whatsapp.php`

**Step 1: Create the file**

```php
    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/919979865551" class="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <style>
        .whatsapp-btn {
            position: fixed;
            bottom: 30px;
            left: 30px;
            background-color: #25d366;
            color: #fff;
            width: 50px;
            height: 50px;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .whatsapp-btn:hover {
            background-color: #128c7e;
            color: #fff;
        }
    </style>
```

---

## Task 5: Add newsletter AJAX to `js/main.js`

**Files:**
- Modify: `js/main.js`

**Step 1: Append to end of `js/main.js`**

Add after the closing `})(jQuery);` at line 137, replacing the commented-out cookie code block (lines 140–169) with this:

```js
// Newsletter form handler — runs on all pages
$(document).ready(function () {
    $('#newsletterForm').on('submit', function (e) {
        e.preventDefault();
        var email = $(this).find('input').val();
        var btn = $(this).find('button');
        btn.prop('disabled', true).text('...');

        $.ajax({
            url: 'php/newsletter.php',
            type: 'POST',
            data: { email: email },
            success: function (res) {
                if (res.success) {
                    $('#newsletterMessage').html('<span class="text-success">' + res.message + '</span>');
                    $('#newsletterForm')[0].reset();
                } else {
                    $('#newsletterMessage').html('<span class="text-warning">' + (res.message || 'Error') + '</span>');
                }
            },
            error: function () {
                $('#newsletterMessage').html('<span class="text-danger">Connection error.</span>');
            },
            complete: function () {
                btn.prop('disabled', false).text('SignUp');
            }
        });
    });
});
```

Note: Remove the commented-out cookie code (lines 140–169) as it is dead code.

---

## Task 6: Create `js/booking.js`

**Files:**
- Create: `js/booking.js`

**Step 1: Create the file**

```js
$(document).ready(function () {
    $('#bookingForm').on('submit', function (e) {
        e.preventDefault();
        var btn = $('#bookingSubmitBtn');
        btn.prop('disabled', true).text('Booking...');

        $.ajax({
            url: 'php/booking.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                if (res.success) {
                    $('#bookingMessageBox').html('<div class="alert alert-success">' + res.message + '</div>');
                    $('#bookingForm')[0].reset();
                } else {
                    $('#bookingMessageBox').html('<div class="alert alert-danger">' + res.message + '</div>');
                }
            },
            error: function () {
                $('#bookingMessageBox').html('<div class="alert alert-danger">Connection error. Please try again.</div>');
            },
            complete: function () {
                btn.prop('disabled', false).text('Book Appointment');
            }
        });
    });
});
```

---

## Task 7: Create `js/contact.js`

**Files:**
- Create: `js/contact.js`

**Step 1: Create the file**

```js
$(document).ready(function () {
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        var btn = $('#contactSubmitBtn');
        btn.prop('disabled', true).text('Sending...');

        $.ajax({
            url: 'php/contact.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                if (res.success) {
                    $('#contactMessageBox').html('<div class="alert alert-success">' + res.message + '</div>');
                    $('#contactForm')[0].reset();
                } else {
                    $('#contactMessageBox').html('<div class="alert alert-danger">' + res.message + '</div>');
                }
            },
            error: function () {
                $('#contactMessageBox').html('<div class="alert alert-danger">Connection error. Please try again.</div>');
            },
            complete: function () {
                btn.prop('disabled', false).text('Send Message');
            }
        });
    });
});
```

---

## Task 8: Create `js/calculator.js`

**Files:**
- Create: `js/calculator.js`

**Step 1: Create the file**

```js
$(document).ready(function () {
    function calculate() {
        var baseMultiplier = parseFloat($('#carSegment').val());
        var total = 0;
        $('.service-check:checked').each(function () {
            total += parseFloat($(this).val());
        });
        var estimatedTotal = total > 0 ? Math.max(Math.round(total * baseMultiplier), 500) : 0;
        $('#totalPrice').text(estimatedTotal.toLocaleString('en-IN'));
    }

    $('#carSegment, .service-check').on('change', calculate);
});
```

---

## Task 9: Convert `index.html` → `index.php`

**Files:**
- Create: `index.php`
- The new file uses partials for head/navbar/footer/whatsapp
- Page body content (carousel, about, facts, app preview) is copied unchanged

**Step 1: Create `index.php`**

Structure:
```php
<?php
$title = 'The Auto Shoppers - Standardized Multi-Brand Car Service';
$keywords = 'car service surat, auto repair adajan, multi-brand car service, standardized car repair';
$description = 'The Auto Shoppers - Surat\'s premier standardized multi-brand car service workshop. Specialized in EFI diagnostics, engine repair, and expert maintenance.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    <!-- Carousel Start -->
    [COPY CAROUSEL HTML FROM index.html LINES 104-167 UNCHANGED]
    <!-- Carousel End -->

    <!-- Service Highlights Start -->
    [COPY LINES 169-206 UNCHANGED]
    <!-- Service Highlights End -->

    <!-- About Start -->
    [COPY LINES 208-263 UNCHANGED]
    <!-- About End -->

    <!-- Fact Start -->
    [COPY LINES 265-292 UNCHANGED]
    <!-- Fact End -->

    <!-- Mobile App Preview Start -->
    [COPY LINES 294-339 UNCHANGED]
    <!-- Mobile App Preview End -->

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
```

Important: Do NOT include the inline `<script>` newsletter block (it's now in `js/main.js` via footer.php).

**Step 2: Verify the page renders correctly**

```
php -S localhost:8000
# Open http://localhost:8000/index.php in browser
# Confirm: logo, navbar, carousel, sections, footer all render
# Confirm: dark mode toggle works
# Confirm: newsletter form visible in footer
```

---

## Task 10: Convert `about.html` → `about.php`

**Files:**
- Create: `about.php`

**Step 1: Create `about.php`**

```php
<?php
$title = 'About Us - The Auto Shoppers';
$keywords = 'car service, auto repair, car maintenance, about auto shoppers';
$description = 'Discover the legacy of The Auto Shoppers. Over 30 years of excellence in automotive repair and service in Surat.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    [COPY PAGE BODY FROM about.html — everything between Navbar End comment and Footer Start comment, UNCHANGED]

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
```

Remove the inline `<script>` newsletter block at the end.

---

## Task 11: Convert `team.html` → `team.php`

**Files:**
- Create: `team.php`

**Step 1: Create `team.php`**

```php
<?php
$title = 'Our Team - The Auto Shoppers';
$keywords = 'auto repair team, car mechanic surat, certified technicians';
$description = 'Meet the expert team at The Auto Shoppers. Certified mechanics and technicians dedicated to your vehicle.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    [COPY PAGE BODY FROM team.html UNCHANGED]

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
```

Remove the inline `<script>` newsletter block.

---

## Task 12: Convert `service.html` → `service.php`

**Files:**
- Create: `service.php`

**Step 1: Create `service.php`**

```php
<?php
$title = 'Services - The Auto Shoppers';
$keywords = 'car service, engine repair, brake service, oil change, AC service surat';
$description = 'Comprehensive car services at The Auto Shoppers: diagnostics, engine repair, brake service, oil change, AC service and more.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    [COPY PAGE BODY FROM service.html UNCHANGED]

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
```

Remove the inline `<script>` newsletter block.

---

## Task 13: Convert `offers.html` → `offers.php`

**Files:**
- Create: `offers.php`

**Step 1: Create `offers.php`**

```php
<?php
$title = 'Offers - The Auto Shoppers';
$keywords = 'car service offers, auto repair discount, surat car deals';
$description = 'Exclusive service offers and seasonal deals at The Auto Shoppers, Surat.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    [COPY PAGE BODY FROM offers.html UNCHANGED]

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
```

Remove the inline `<script>` newsletter block.

---

## Task 14: Convert `calculator.html` → `calculator.php`

**Files:**
- Create: `calculator.php`

**Step 1: Create `calculator.php`**

```php
<?php
$title = 'Service Calculator - The Auto Shoppers';
$keywords = 'car service cost calculator, auto repair estimate surat';
$description = 'Estimate your car service cost with The Auto Shoppers service price calculator.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    [COPY PAGE BODY FROM calculator.html UNCHANGED]

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
    <script src="js/calculator.js"></script>
</body>
</html>
```

Remove the entire inline `<script>` block (both newsletter and calculator logic are now in JS files).

---

## Task 15: Convert `contact.html` → `contact.php`

**Files:**
- Create: `contact.php`

**Step 1: Create `contact.php`**

```php
<?php
$title = 'Contact Us - The Auto Shoppers';
$keywords = 'contact auto shoppers, car service contact surat, auto repair inquiry';
$description = 'Get in touch with The Auto Shoppers. Contact us for car service inquiries, bookings, and support.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    [COPY PAGE BODY FROM contact.html UNCHANGED]

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
    <script src="js/contact.js"></script>
</body>
</html>
```

Remove the entire inline `<script>` block (contact AJAX now in contact.js, newsletter AJAX now in main.js).

---

## Task 16: Convert `booking.html` → `booking.php`

**Files:**
- Create: `booking.php`

**Step 1: Create `booking.php`**

```php
<?php
$title = 'Book Service - The Auto Shoppers';
$keywords = 'car service booking, auto repair appointment, surat car repair';
$description = 'Schedule your car service appointment online at The Auto Shoppers. Convenient, reliable, and expert care for your vehicle.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    [COPY PAGE BODY FROM booking.html UNCHANGED]

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
    <script src="js/booking.js"></script>
</body>
</html>
```

Remove the entire inline `<script>` block (booking AJAX now in booking.js, newsletter AJAX now in main.js).

---

## Task 17: Convert `updates.html` → `updates.php`

**Files:**
- Create: `updates.php`

**Step 1: Create `updates.php`**

```php
<?php
$title = 'Updates - The Auto Shoppers';
$keywords = 'auto shoppers news, car service updates surat';
$description = 'Latest news and updates from The Auto Shoppers workshop in Surat.';
require 'partials/head.php';
?>
<body>
<?php require 'partials/navbar.php'; ?>

    [COPY PAGE BODY FROM updates.html UNCHANGED]

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>
</body>
</html>
```

Remove the inline `<script>` newsletter block.

---

## Task 18: Update internal `.html` links → `.php` in all new PHP pages

**Files:**
- Modify: all 9 `.php` pages (page body sections)

**Step 1: Search for remaining .html hrefs**

```bash
grep -r '\.html' *.php partials/
```

**Step 2: Fix any remaining `.html` links found**

Common locations to check in page bodies:
- Breadcrumb links (e.g., `href="index.html"`)
- "Read More" links
- CTA buttons pointing to other pages

Use Edit tool to update each occurrence from `.html` to `.php`.

**Step 3: Verify no .html links remain in .php files**

```bash
grep -r '\.html' *.php partials/
```

Expected: no output (only .html links to external resources like CDNs are acceptable, those won't match this pattern).

---

## Task 19: Update admin panel links

**Files:**
- Check: `admin/index.php`, `admin/login.php`, `admin/bookings.php`, `admin/contacts.php`, `admin/newsletter.php`

**Step 1: Check for .html links in admin**

```bash
grep -r '\.html' admin/
```

**Step 2: Update any links found**

If admin pages link back to the frontend (e.g., "Back to site" links), update `.html` → `.php`.

---

## Task 20: Delete old `.html` files

**Files:**
- Delete: `index.html`, `about.html`, `team.html`, `service.html`, `offers.html`, `calculator.html`, `contact.html`, `booking.html`, `updates.html`

**Step 1: Confirm all .php replacements exist**

```bash
ls *.php
```

Expected: `index.php about.php team.php service.php offers.php calculator.php contact.php booking.php updates.php`

**Step 2: Delete old HTML files**

```bash
rm index.html about.html team.html service.html offers.html calculator.html contact.html booking.html updates.html
```

---

## Task 21: End-to-end verification

**Step 1: Start dev server**

```bash
php -S localhost:8000
```

**Step 2: Test each page**

Visit each URL and verify:
- [ ] `http://localhost:8000/index.php` — homepage renders, carousel works, dark mode works
- [ ] `http://localhost:8000/about.php` — content renders, navbar active link = About
- [ ] `http://localhost:8000/team.php` — content renders
- [ ] `http://localhost:8000/service.php` — services listed
- [ ] `http://localhost:8000/offers.php` — offers listed
- [ ] `http://localhost:8000/calculator.php` — calculator responds to checkbox changes
- [ ] `http://localhost:8000/contact.php` — contact form submits (check browser network tab)
- [ ] `http://localhost:8000/booking.php` — booking form submits
- [ ] `http://localhost:8000/updates.php` — updates render
- [ ] Newsletter form in footer on any page — submits to `php/newsletter.php`
- [ ] Admin panel at `http://localhost:8000/admin/login.php` — still works

**Step 3: Commit**

```bash
git add partials/ js/main.js js/booking.js js/contact.js js/calculator.js *.php docs/
git add -u  # stage deleted .html files
git commit -m "refactor: modularize site with PHP partials and deduplicated JS handlers"
```

---

## Summary of Changes

| Before | After |
|--------|-------|
| 9 HTML files, each 300-490 lines | 9 PHP files, each ~50-150 lines (body only) |
| Newsletter AJAX duplicated 9× | Newsletter AJAX once in `js/main.js` |
| Navbar HTML duplicated 9× | One `partials/navbar.php` |
| Footer HTML duplicated 9× | One `partials/footer.php` |
| `<head>` duplicated 9× | One `partials/head.php` |
| WhatsApp button duplicated 9× | One `partials/whatsapp.php` |
| Booking/contact/calculator AJAX inline | `js/booking.js`, `js/contact.js`, `js/calculator.js` |
