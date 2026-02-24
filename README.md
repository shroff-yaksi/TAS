<div align="center">

# 🚗 The Auto Shoppers

**Premium car servicing & detailing — online, done right.**

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

</div>

---

## ✨ Overview

TAS is the official website for **The Auto Shoppers**, a car servicing and detailing business. It features a real-time service price calculator, a contact form backed by PHPMailer SMTP, dark mode by default, and a password-protected admin panel — all built as a clean, responsive PHP site with a premium aesthetic.

---

## 🖥️ Pages

| Page | Description |
|------|-------------|
| **Home** | Hero section, promotions, services overview, app teaser |
| **Services** | Full service catalogue with pricing |
| **Calculator** | Real-time quote builder — 8 services, ₹500 minimum |
| **Offers** | Current deals and promotions |
| **About** | Company story |
| **Team** | Team profiles |
| **Contact** | Smart contact form with SMTP email |
| **Admin** | Password-protected booking & enquiry panel |

---

## ⚙️ Tech Stack

| Layer | Tech |
|-------|------|
| Structure | HTML5 |
| Styling | CSS3 — custom dark mode, mobile-first |
| Interactivity | Vanilla JS · jQuery |
| Animations | WOW.js · Animate.css |
| Backend | PHP 8 |
| Email | PHPMailer SMTP (`mail()` fallback) |
| Icons | Font Awesome |

---

## 🌙 Highlights

- **Dark mode on by default** — persisted via `localStorage`, toggles on both desktop and mobile nav
- **Live service calculator** — 8 services, real-time total, ₹500 minimum charge enforced
- **PHPMailer SMTP** — reliable email delivery, credentials loaded from environment variables
- **Responsive nav** — hamburger menu with mobile overflow fix

---

## 🚀 Run Locally

```bash
cd TAS
php -S localhost:8000
# → http://localhost:8000
```

> For email to work in production, install PHPMailer and set env vars:
> `SMTP_HOST` · `SMTP_USER` · `SMTP_PASS` · `SMTP_PORT`

---

<div align="center">
<sub>Built for The Auto Shoppers · Car Servicing & Detailing</sub>
</div>
