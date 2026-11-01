# 🎓 Student Management System (SMS) & Academic Portal

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tests](https://img.shields.io/badge/Tests-15%20Passed%20(60%20Assertions)-success?style=for-the-badge&logo=checkmarx&logoColor=white)]()
[![License](https://img.shields.io/badge/License-MIT-blue.svg?style=for-the-badge)](LICENSE)

An enterprise-ready **Student Information & Academic Management System** engineered with **Laravel 12**, **Blade**, and **Tailwind CSS**. Developed as an institutional portal during internship training with the **Punjab Information Technology Board (PITB)**.

The platform provides centralized administration for academic departments, course allocations, student records, role-based dashboards, and pre-authorized self-registration with automated security controls.

---

## 🌟 Key Features

### 1. 🛡️ Role-Based Access Control & Multi-Tier Architecture
- **Admin & Student Separation**: Dedicated dashboards and route spaces strictly isolated via custom middleware (`AdminMiddleware`).
- **Administrative Privileges Guard**: System enforces a hard safety limit of at most 3 active system administrators.
- **Session Revocation on Privilege Escalation**: Promoting a user to administrator immediately invalidates all active sessions across all devices in the database session store, forcing re-authentication.
- **Self-Demotion Prevention**: Administrators cannot alter or demote their own roles.

### 2. 🔐 Security-Hardened Authentication
- **Pre-Authorized Student Registration**: Open registration is restricted; only students whose institutional records and email addresses have been pre-registered by administration can create an account, preventing unauthorized account creation.
- **Dynamic Anti-Bot Captcha**: Built-in alphanumeric session captcha with cryptographically secure random generation and timing-safe comparison (`hash_equals`).
- **Secure Password Reset Flow**: Tokenized password reset mechanism with custom notification delivery and strict password complexity rules.
- **Full Security Headers**: Custom `SecurityHeadersMiddleware` enforcing `X-Frame-Options: DENY`, `X-Content-Type-Options: nosniff`, `Referrer-Policy`, `Permissions-Policy`, and HTTP Strict Transport Security (`HSTS`).

### 3. 👨‍🎓 Student Profile & IDOR-Protected Document Management
- **Direct Object Reference (IDOR) Protection**: Student self-service routes operate strictly against `Auth::user()->student` rather than user-supplied URL IDs, completely eliminating horizontal privilege escalation vulnerabilities.
- **Private Document & Media Storage**: Student verification documents (PDFs up to 5MB) and profile photos (up to 2MB) are stored in private disks, accessible only through streaming response gates and authenticated download routes.
- **Self-Service Portal**: Students can update allowed personal information, upload/replace academic documents, and download profile assets.

### 4. 🏢 Department & Academic Roster Management
- **Roster & Department Operations**: Full CRUD for academic departments with unique code constraints.
- **Batch Student Enrollment**: Enroll individual or multiple students into academic departments with duplicate and conflict prevention.
- **Automated Orphan Prevention**: Safely unenrolling or deleting departments cleanly decouples student associations without data corruption.
- **Fast Filter & Search**: Search department rosters by name and code with paginated results.

### 5. 📚 Subject & Course Allocation
- **Many-to-Many Academic Mapping**: Assign and manage subjects across enrolled students via relational pivot tables (`student_subjects`).
- **Sync & Detach Engine**: Attach courses to cohorts without detaching existing enrollments, plus clean unassignment workflows.

### 6. 🏛️ Campus Portal Information Suite
- Dedicated informational portals for **Academic Records**, **Digital Library**, **Campus Community**, **Research & Discovery**, and **IT Help-Desk**.

---

## 🧪 Automated Testing & Quality Assurance

The application features comprehensive automated unit and feature test coverage utilizing **PHPUnit**:

- ✅ **Authentication & Captcha Verification**: Verifies case sensitivity, session regeneration, and anti-replay logic.
- ✅ **Password Reset Flow**: End-to-end token validation, email routing, and credential confirmation.
- ✅ **Route Authorization & Middleware**: Ensures guest redirection, 403 Forbidden enforcement on administrative endpoints, and IDOR protection.
- ✅ **Pre-Authorized Registration**: Verifies that unapproved emails are rejected and approved emails link cleanly to existing student records.
- ✅ **File Storage & Access Controls**: Tests file uploads, streaming, deletion, and download isolation using mocked `Storage::fake()`.
- ✅ **Department Lifecycle**: Validates cascade safety, batch enrollment, and update constraints.

```bash
php artisan test
```

```
   PASS  Tests\Unit\ExampleTest
  ✓ that true is true

   PASS  Tests\Feature\AuthCaptchaTest
  ✓ login rejects lowercase input for an uppercase captcha
  ✓ login accepts exact case for an uppercase captcha

   PASS  Tests\Feature\AuthPasswordResetTest
  ✓ user can request a password reset link and reset password
  ✓ password reset requires matching confirmation

   PASS  Tests\Feature\ExampleTest
  ✓ guests are redirected to login
  ✓ regular users cannot access admin routes
  ✓ admin can access student creation page
  ✓ admin can manage departments and students are unassigned when one is deleted
  ✓ registration requires an unclaimed pre authorized student email
  ✓ student can only reach their own profile route
  ✓ admin can update own basic details but cannot submit a role change
  ✓ regular user cannot download student pdf documents
  ✓ student can upload and download only their own pdf document
  ✓ student can download their own profile picture

  Tests:    15 passed (60 assertions)
```

---

## 🛠️ Technology Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | Laravel 12.x |
| **Language** | PHP 8.2+ |
| **Database** | SQLite (Development/Testing) / MySQL (Production) |
| **ORM** | Eloquent ORM |
| **Frontend Templating** | Blade, Alpine.js / Vite |
| **Styling** | Tailwind CSS / Custom Responsive CSS |
| **Testing** | PHPUnit 11 |
| **Security** | CSRF, Session Invalidation, Custom Headers Middleware, Timing-Safe Captcha |

---

## 🚀 Getting Started

### Prerequisites
- **PHP** >= 8.2 with SQLite, PDO, and OpenSSL extensions
- **Composer** >= 2.0
- **Node.js** >= 18.x & **NPM**

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Subhanjavaid12/Student-management-.git
   cd Student-management-
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install Node dependencies & build assets:**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup:**
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

5. **Run Migrations & Seed Initial Admin:**
   Configure your administrator credentials in `.env` if desired (defaults to `admin@example.com` / `admin12345`):
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminUserSeeder
   ```

6. **Start the local development server:**
   ```bash
   php artisan serve
   ```
   Navigate to `http://127.0.0.1:8000` in your browser.

---

## 👤 Author & Acknowledgments

- **Developer**: Subhan Javaid ([GitHub](https://github.com/Subhanjavaid12))
- **Affiliation**: Built during the software engineering internship at the **Punjab Information Technology Board (PITB)**.

---

## 📄 License
This project is open-sourced under the [MIT License](LICENSE).
