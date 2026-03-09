# AGENTS.md - TAS (The Auto Shoppers)

## Project Overview

TAS is a multi-page PHP website for a car servicing and detailing business using server-rendered HTML with PHP/SQLite backend. No build tools or package managers needed.

## Development Server

```bash
php -S localhost:8000
# Visit http://localhost:8000
```

## Build/Lint/Test Commands

### Linting (WebHint - Accessibility)
```bash
npx hint http://localhost:8000
npx hint http://localhost:8000/index.php
npx hint http://localhost:8000/service.php
```

### Running a Single Page Check
```bash
npx hint http://localhost:8000/<page>.php
```

### PHP Syntax Check
```bash
php -l <filename>.php
# Example: php -l php/db.php
```

### Database
- SQLite: `data/tas.db` (auto-created)
- Error logs: `data/error.log`

---

## Code Style Guidelines

### PHP Conventions

**File Structure**
- All PHP files start with `<?php`
- Filenames: lowercase with underscores (e.g., `db.php`, `utils.php`)
- Classes in `php/`, page handlers in root
- Include order: config.php → db.php → utils.php

**Naming Conventions**
- Classes: PascalCase (`Database`, `PHPMailer`)
- Functions: snake_case (`sanitizeInput`, `generateBookingId`)
- Constants: UPPER_SNAKE_CASE (`DB_PATH`, `FROM_EMAIL`)
- Variables: camelCase (`$db`, `$conn`, `$stmt`)

**Formatting**
- Use 4 spaces for indentation
- Opening brace on same line for classes/functions
- Opening brace on new line for control structures
- Max line length: ~120 characters

**Error Handling**
- Use try-catch for database operations
- Log errors to `data/error.log`
- Never expose sensitive info in error messages

### Database (SQLite/PDO)

```php
$stmt = $db->prepare("SELECT * FROM table WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();
```

**Table Creation**: Use `IF NOT EXISTS`, TEXT for strings, INTEGER for numbers, include timestamps

**Security**
- Always use parameterized queries (never string concatenation)
- Sanitize all user inputs with `sanitizeInput()`
- Use CSRF tokens for all forms (`getCsrfToken()`, `verifyCsrfToken()`)
- Hash passwords with `password_hash()` / `password_verify()`
- Implement rate limiting on public endpoints

### JavaScript/jQuery

**File Structure**: `js/main.js`, `js/login.js`, `js/cookies.js`

**Code Style**
- Use `"use strict"` in IIFE wrappers
- Wrap in IIFE: `(function($) { ... })(jQuery);`
- Use `$(document).ready()` for page-specific logic
- Use `const` and `let` instead of `var`

**AJAX**: Use jQuery's `$.ajax()` or `$.post()`, handle success/error/complete callbacks

**Dark Mode**: Default ON, toggle via `body.dark-mode` class, persist in `localStorage` under key `darkMode`

### HTML/PHP Templates

- Use semantic HTML5 elements
- Include CSRF token in forms: `<input type="hidden" name="csrf_token" value="<?php echo getCsrfToken(); ?>">`
- Escape output with `htmlspecialchars()`

### Admin Panel

**Location**: `admin/` directory

**Authentication**: Session-based via `admin/auth.php`, include at top of every protected page

**Default credentials**: `admin` / `admin123`

---

## Key Patterns

### Input Sanitization
```php
$data = sanitizeInput($_POST['field']);
```

### Rate Limiting
```php
if (isRateLimited('contact', 5, 3600)) {
    http_response_code(429);
    echo json_encode(['success' => false, 'message' => 'Too many requests']);
    exit;
}
```

### Email Sending
```php
$body = getEmailTemplate('Subject', $content);
sendEmail($to, 'Subject', $body);
```

### JSON Response
```php
header('Content-Type: application/json');
echo json_encode(['success' => true, 'data' => $data]);
```

---

## Directory Structure

```
TAS/
├── index.php, service.php, calculator.php, offers.php, about.php, team.php, contact.php, booking.php, updates.php
├── admin/          # login.php, index.php, auth.php
├── php/            # db.php, config.php, utils.php, contact.php, booking.php, newsletter.php, faq.php
├── js/             # main.js, cookies.js, login.js
├── css/            # Stylesheets
├── partials/       # Reusable templates
├── data/           # SQLite DB & logs
└── lib/            # Vendored libraries
```

## Important Notes

1. **No composer/npm**: All dependencies vendored in `lib/` or included directly
2. **PHPMailer**: Falls back to native `mail()` unless installed separately
3. **SQLite**: Auto-creates tables on first connection
4. **Dark mode**: OFF by default, persisted in localStorage
