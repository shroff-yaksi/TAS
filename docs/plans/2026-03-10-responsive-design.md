# Responsive Design Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Make the entire TAS website fully responsive across phones (320px), tablets (768px), and mid-size laptops (1200px).

**Architecture:** Option B — fix broken HTML structure in ~5 specific spots, then add comprehensive missing media queries to `css/style.css`. All layout changes are targeted and surgical; shared partials are touched only where necessary.

**Tech Stack:** PHP, Bootstrap 5, vanilla CSS (no build tools)

---

## What's Broken (Root Cause Analysis)

| Issue | Location | Root Cause |
|---|---|---|
| About badge overflows viewport | `index.php:192`, `about.php:16` | `mt-n5 ms-n5` = -3rem negative margin escapes viewport on mobile |
| Booking form too cramped | `booking.php:52` | `p-5` (3rem) padding is excessive on mobile |
| Contact map collapses to 0 | `contact.php:48` | `h-100` with no height on parent col |
| Navbar brand overflows | `partials/navbar.php:13` | Long text + logo on 375px phone |
| Carousel too tall on mobile | `css/style.css:537` | `calc(100vh - 76px)` with no mobile cap |
| Topbar shows on tiny screens | No media query hiding it | Wastes vertical space |
| Section spacing too large | Various `py-5` sections | No mobile reduction |
| Footer newsletter button cut | `partials/footer.php:47` | `position-absolute` button inside small container |

---

### Task 1: Fix about-badge negative-margin overflow (index.php + about.php)

**Files:**
- Modify: `index.php:192-198`
- Modify: `about.php:16-20`

This badge `<div class="position-absolute top-0 start-0 bg-light ... mt-n5 ms-n5">` overflows the left edge on mobile. Replace with a CSS class-based approach that only applies negative offset on `lg+`.

**Step 1: Replace inline negative-margin on `index.php` about badge**

Find this block (~line 192 in index.php):
```php
<div class="position-absolute top-0 start-0 bg-light d-flex align-items-center justify-content-center mt-n5 ms-n5"
    style="width: 150px; height: 150px;">
```

Replace with:
```php
<div class="position-absolute top-0 start-0 bg-light d-flex align-items-center justify-content-center about-badge"
    style="width: 150px; height: 150px;">
```

**Step 2: Same fix in `about.php`**

`about.php` does NOT have this badge (the About page image has no overlay badge — the badge is only in `index.php`). No change needed here.

**Step 3: Add `.about-badge` CSS to `css/style.css`** (do this in Task 6 with all CSS)

**Step 4: Commit**
```bash
git add index.php
git commit -m "fix: replace negative-margin about badge with responsive CSS class"
```

---

### Task 2: Fix booking form padding on mobile

**Files:**
- Modify: `booking.php:52`

**Step 1: Update the form container div**

Find (~line 52):
```php
<div class="bg-light h-100 d-flex flex-column justify-content-center p-5 wow zoomIn"
```

Replace with:
```php
<div class="bg-light h-100 d-flex flex-column justify-content-center p-3 p-md-4 p-lg-5 wow zoomIn"
```

**Step 2: Commit**
```bash
git add booking.php
git commit -m "fix: responsive padding on booking form container"
```

---

### Task 3: Fix contact map iframe height

**Files:**
- Modify: `contact.php:48-51`

**Step 1: Update the iframe**

Find (~line 48):
```php
<iframe class="position-relative rounded w-100 h-100"
    src="https://www.google.com/maps/embed?..."
    frameborder="0" style="min-height: 350px; border:0;" ...
```

Replace `h-100` with nothing (it collapses without parent height), and keep the explicit min-height:
```php
<iframe class="position-relative rounded w-100"
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232.48880114516265!2d72.77910821436583!3d21.199281930565146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04d948b9cbc91%3A0x1e6dcd8d36cce190!2sThe%20Auto%20Shoppers!5e0!3m2!1sen!2sin!4v1772800171666!5m2!1sen!2sin"
    frameborder="0" style="min-height: 400px; height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
    tabindex="0"></iframe>
```

**Step 2: Commit**
```bash
git add contact.php
git commit -m "fix: contact map iframe height no longer relies on collapsed h-100"
```

---

### Task 4: Fix navbar brand overflow on small screens

**Files:**
- Modify: `partials/navbar.php:13-20`

The brand `<h2>` contains a logo image + full text "THE AUTO SHOPPERS". On 375px phones with the toggler at `me-4`, this combination is too wide.

**Step 1: Add `text-truncate` approach — hide text on xs, show on sm+**

Find (~line 14-19):
```php
<h2 class="m-0 text-danger d-flex align-items-center gap-1"
    style="font-family: 'Times New Roman', Times, serif; font-weight: 700; letter-spacing: 0.5px;">
    <img src="img/tas_logo_light_theme.png" alt="TAS Logo" class="logo-light" style="max-height: 40px;">
    <img src="img/tas_logo_dark_theme.png" alt="TAS Logo" class="logo-dark" style="max-height: 40px;">
    THE AUTO SHOPPERS
</h2>
```

Replace with:
```php
<h2 class="m-0 text-danger d-flex align-items-center gap-1"
    style="font-family: 'Times New Roman', Times, serif; font-weight: 700; letter-spacing: 0.5px;">
    <img src="img/tas_logo_light_theme.png" alt="TAS Logo" class="logo-light" style="max-height: 36px;">
    <img src="img/tas_logo_dark_theme.png" alt="TAS Logo" class="logo-dark" style="max-height: 36px;">
    <span class="navbar-brand-text">THE AUTO SHOPPERS</span>
</h2>
```

**Step 2: Add `.navbar-brand-text` CSS in Task 6**

**Step 3: Commit**
```bash
git add partials/navbar.php
git commit -m "fix: wrap navbar brand text in span for responsive hiding"
```

---

### Task 5: Add topbar hide on mobile (partials/head.php has no topbar — topbar is inline in index.php if present)

Check: the topbar `container-fluid.bg-dark` is used in some pages. Actually — reviewing the pages, none of the current PHP pages include a topbar (that was part of the old template). Skip this task.

---

### Task 6: Add all missing CSS media queries to style.css

**Files:**
- Modify: `css/style.css` — append to end of file

This is the main fix. Add a comprehensive responsive block at the bottom of `style.css`.

**Step 1: Append the following CSS block to the END of `css/style.css`:**

```css
/* =============================================
   RESPONSIVE FIXES — Added 2026-03-10
   Breakpoints: ≤1200px, ≤992px, ≤768px, ≤576px
   ============================================= */

/* About badge — only show negative offset on lg+ */
.about-badge {
    position: absolute;
    top: 0;
    left: 0;
}

@media (min-width: 992px) {
    .about-badge {
        margin-top: -3rem;
        margin-left: -3rem;
    }
}

/* Navbar brand text — hide on very small screens */
@media (max-width: 400px) {
    .navbar-brand-text {
        display: none;
    }
}

/* Carousel — cap height on mobile to avoid full-screen carousel */
@media (max-width: 768px) {
    #header-carousel .carousel-item {
        height: 60vh;
        min-height: 340px;
    }
}

@media (max-width: 576px) {
    #header-carousel .carousel-item {
        height: 55vh;
        min-height: 300px;
    }

    .carousel-caption {
        padding: 10px;
    }
}

/* About section image — ensure proper height when stacked */
@media (max-width: 991.98px) {
    .about-img-col {
        min-height: 300px !important;
    }
}

/* Section padding reduction on mobile */
@media (max-width: 576px) {
    .container-xxl,
    .container-fluid:not(.bg-dark):not(.fact) {
        padding-left: 12px;
        padding-right: 12px;
    }

    section.py-5,
    div.py-5:not(.fact) {
        padding-top: 2.5rem !important;
        padding-bottom: 2.5rem !important;
    }
}

/* Fact / counter bar — 2-col on mobile */
@media (max-width: 576px) {
    .fact .col-md-6 {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
}

/* Service items — single column on mobile already via Bootstrap, just fix icon size */
@media (max-width: 576px) {
    .service-item .btn-square {
        width: 48px;
        height: 48px;
        font-size: 22px;
        flex-shrink: 0;
    }

    .service-item h5 {
        font-size: 16px;
    }
}

/* Booking info panel — reduce p-4 box padding on mobile */
@media (max-width: 576px) {
    .bg-danger.p-4 {
        padding: 1rem !important;
    }

    .bg-danger.p-4 h5 {
        font-size: 16px;
    }
}

/* Contact info boxes — stack properly */
@media (max-width: 576px) {
    .contact-info-box {
        padding: 1rem !important;
    }
}

/* Contact map — full height on mobile */
@media (max-width: 767px) {
    .contact-map-iframe {
        height: 280px !important;
        min-height: 280px !important;
    }
}

/* Footer newsletter — fix button overlap inside small containers */
@media (max-width: 576px) {
    .footer .position-relative input.form-control {
        padding-right: 5rem;
    }
}

/* Footer columns — stack properly on sm */
@media (max-width: 576px) {
    .footer .col-lg-5 .row .col-6 a.btn-link {
        font-size: 13px;
        padding: 4px 0;
    }
}

/* App store buttons — stack on mobile */
@media (max-width: 576px) {
    .app-store-btn {
        min-width: 130px;
        padding: 8px 14px;
    }

    .app-store-btn .btn-text span {
        font-size: 14px;
    }
}

/* Team cards — 2 across on sm tablets */
@media (max-width: 576px) {
    .team-item .team-text h5 {
        font-size: 15px;
    }
}

/* Updates / blog cards — full width image */
@media (max-width: 576px) {
    .updates-card img.img-fluid {
        width: 100%;
        object-fit: cover;
        height: 180px;
    }
}

/* WhatsApp + back-to-top — smaller on mobile so they don't dominate */
@media (max-width: 576px) {
    .whatsapp-btn {
        width: 44px;
        height: 44px;
        font-size: 24px;
        bottom: 20px;
        left: 16px;
    }

    .back-to-top {
        right: 16px;
        bottom: 20px;
        width: 40px;
        height: 40px;
    }
}

/* Mobile App Preview — reduce inner padding */
@media (max-width: 576px) {
    .bg-primary.rounded.p-5 {
        padding: 1.5rem !important;
    }

    .bg-primary.rounded h1.display-4 {
        font-size: 1.8rem;
    }
}

/* General heading scale on mobile */
@media (max-width: 576px) {
    h1 {
        font-size: clamp(1.4rem, 6vw, 2rem);
    }

    .display-3 {
        font-size: clamp(1.6rem, 7vw, 2.5rem);
    }
}

/* Prevent any horizontal overflow */
body {
    overflow-x: hidden;
}
```

**Step 2: Also add `about-img-col` class to the about image column in index.php and about.php**

In `index.php` (~line 188):
```php
<div class="col-lg-6 pt-4 about-img-col" style="min-height: 400px;">
```

In `about.php` (~line 15):
```php
<div class="col-lg-6 pt-4 about-img-col" style="min-height: 400px;">
```

**Step 3: Add `contact-map-iframe` class to contact.php iframe**

In `contact.php` (~line 49):
```php
<iframe class="position-relative rounded w-100 contact-map-iframe"
```

**Step 4: Run dev server and test manually at 375px, 768px, 1024px, 1200px**
```bash
php -S localhost:8000
# Open browser DevTools → Toggle Device Toolbar → test each page at:
# iPhone SE (375px), iPad (768px), iPad Pro (1024px), Surface Laptop (1280px)
```

Check each page:
- [ ] Navbar fits without overflow at 375px
- [ ] Carousel is reasonably sized at 375px
- [ ] About badge doesn't overflow left edge
- [ ] Services page — cards stack cleanly
- [ ] Booking page — form has breathing room
- [ ] Contact page — map visible, form stacked
- [ ] Team page — cards show 2-per-row on tablet
- [ ] Footer — newsletter input + button not overlapping
- [ ] WhatsApp + back-to-top don't cover content

**Step 5: Commit**
```bash
git add css/style.css index.php about.php contact.php
git commit -m "feat: comprehensive responsive CSS for phones, tablets, and mid laptops"
```

---

### Task 7: Final cross-browser check and wrap-up

**Step 1: Verify no horizontal scroll on any page at 375px**

In browser DevTools console:
```javascript
document.querySelectorAll('*').forEach(el => {
  if (el.offsetWidth > document.documentElement.offsetWidth) {
    console.log('Overflow:', el, el.offsetWidth);
  }
});
```

Fix any reported overflowing elements by adding `max-width: 100%; overflow-x: hidden;` or adjusting the specific rule.

**Step 2: Fix any overflow elements found**

Add targeted rules to `css/style.css`.

**Step 3: Final commit**
```bash
git add css/style.css
git commit -m "fix: patch remaining horizontal overflow elements on mobile"
```

---

## Testing Checklist

| Page | 375px | 768px | 1024px | 1200px |
|---|---|---|---|---|
| index.php | carousel, about badge, app section | | | |
| service.php | service cards | | | |
| booking.php | form padding, two-col form fields | | | |
| contact.php | map height, form | | | |
| about.php | image + text stack | | | |
| team.php | team cards | | | |
| updates.php | blog card images | | | |
| footer | newsletter button | | | |
