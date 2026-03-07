# TAS Codebase Modularization Design

**Date:** 2026-03-07
**Approach:** Option B — PHP Partials + Newsletter JS Consolidation

## Problem

The codebase has significant duplication:
- Navbar HTML copied across all 9 HTML pages
- Footer HTML copied across all 9 HTML pages
- `<head>` boilerplate copied across all 9 HTML pages
- WhatsApp button + inline `<style>` copied across all 9 HTML pages
- Newsletter AJAX handler (`$('#newsletterForm').on('submit', ...)`) copied into all 9 pages' inline `<script>` blocks
- Some pages (booking, contact, calculator) also have page-specific inline AJAX that belongs in dedicated JS files

## Constraints

- No UI or functionality changes
- Hosted on Hostinger (HTML/PHP hosting — serves .php natively)
- No build tools, no npm, no Composer

## Architecture

### New Directory: `partials/`

| File | Contents |
|------|----------|
| `partials/head.php` | `<head>` tag with all CSS/font links; accepts `$title` and `$description` PHP vars |
| `partials/navbar.php` | Full navbar HTML (unchanged markup) |
| `partials/footer.php` | Full footer HTML including newsletter form (unchanged markup) |
| `partials/whatsapp.php` | WhatsApp floating button + its inline `<style>` block |

### File Renames: `.html` → `.php`

All 9 pages renamed. Internal links updated from `.html` to `.php`.

| Old | New |
|-----|-----|
| index.html | index.php |
| about.html | about.php |
| team.html | team.php |
| service.html | service.php |
| offers.html | offers.php |
| calculator.html | calculator.php |
| contact.html | contact.php |
| booking.html | booking.php |
| updates.html | updates.php |

### JS Changes

| File | Change |
|------|--------|
| `js/main.js` | Add newsletter AJAX handler (removes it from all 9 pages) |
| `js/booking.js` | New — booking form AJAX extracted from booking.php |
| `js/contact.js` | New — contact form AJAX extracted from contact.php |
| `js/calculator.js` | New — calculator AJAX/logic extracted from calculator.php |

### PHP File Structure (per page)

```php
<?php $title = 'Page Title'; $description = 'Page description'; ?>
<?php require 'partials/head.php'; ?>
<body>
<?php require 'partials/navbar.php'; ?>

<!-- PAGE BODY — unchanged HTML -->

<?php require 'partials/footer.php'; ?>
<?php require 'partials/whatsapp.php'; ?>

<!-- JS Libraries (same as before) -->
<script src="js/main.js"></script>
<!-- page-specific JS if needed -->
</body>
</html>
```

## What Does NOT Change

- All CSS classes, IDs, HTML structure
- All PHP backend files (`php/`, `admin/`)
- All `lib/` vendored assets
- Visual appearance
- All functionality
- `js/cookies.js`, `js/login.js`

## Success Criteria

- All 9 pages render identically before and after
- Newsletter form works on all pages
- Booking, contact, calculator forms work
- Admin panel unaffected
- No broken links
