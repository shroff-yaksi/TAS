# 📋 TAS (The Auto Shoppers) — Remaining Tasks
> Last updated: February 24, 2026 — All critical items resolved 🎉

---

## 🔴 Critical — UI Fixes (Must fix before next demo)

- [x] **Fix navbar overflow on small screens** — added `max-height: 90vh; overflow-y: auto` to `.navbar-collapse` in `style.css`
- [x] **Fix dark mode background on Calculator page** — added explicit `.container-xxl .bg-light` dark override in `style.css`
- [x] **Resolve spinner/loading issue** — spinner timeout increased from 1ms → 300ms in `main.js` to allow DOM/WOW.js to settle
- [x] **App Store section styling** (Home page) — replaced `btn-dark` with `.app-store-btn` badge class; shows icon + two-line text + "Soon" tag

---

## 🟡 Medium Priority — Backend & Performance

- [x] **Migrate email to PHPMailer (SMTP)** — `sendEmail()` in `utils.php` now uses PHPMailer (from Composer vendor) with SMTP env vars; falls back to native `mail()` gracefully
- [ ] **Optimize all images to WebP** — convert existing JPG/PNG assets to WebP for faster page loads
- [x] **Refine Service Calculator logic** — expanded to 8 services, added ₹500 minimum charge, improved JS logic with zero-selection handling

---

## 🟢 Low Priority / Future Scope

- [ ] Multi-language support (English / Gujarati / Hindi)
- [ ] PDF receipt generation for bookings via Admin panel
- [ ] Customer reviews & star rating system
- [ ] Admin dashboard analytics charts (booking volume over time)

---

## ✅ Already Done (reference)
- SQLite database + all PHP handlers refactored
- Premium Dark UI with glassmorphism
- Persistent dark mode toggle (LocalStorage)
- Admin panel (`/admin`) with secure login
- WhatsApp & social media integration
- Interactive Service Calculator (core logic)
- Navbar standardized across all pages (Calculator link + Book Service button)
- Dark Mode toggle in mobile menu
- All logo-containing images replaced with clean versions

---

## 📌 Notes
- PHP server: port 8000
- Admin: `/admin` → `admin` / `admin123`
- Booking forms use SQLite via PHP — test thoroughly after any PHP changes
