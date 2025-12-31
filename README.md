# MCQ Exam & Evaluation System

A full-featured **Quiz / MCQ Evaluation System** built with **Laravel**, designed to simulate real-world online examinations.  
The system supports **multiple tests**, **time-bound exams**, **multi-correct questions**, and **automatic evaluation**, with strict role-based access control.

---

## Tech Stack
- Laravel
- Blade Templates
- Tailwind CSS
- MySQL
- Laravel Socialite (Google Authentication)

---

## Features

### 🔐 Authentication
- Email & Password authentication
- Google Login using Socialite
- Email verification support
- Secure session-based authentication

---

### 👤 Role System
- Single `users` table
- Role-based access using a `role` column
- Supported roles:
  - **Admin**
  - **Student**

---

### 🛠 Admin Features
- Create and manage multiple MCQ tests
- Set **start date** and **expiry date** for each test
- Add, edit, and delete questions
- Assign marks per question
- Add multiple options per question
- Support for **multiple correct answers**
- View all questions and correct answers
- Restrict admin-only pages using authorization checks

---

### 🎓 Student Features
- View available tests based on date & time
- Attempt each test **only once**
- Answer MCQs (single or multiple correct)
- Auto-calculated evaluation on submission
- Instant result generation
- Prevent duplicate submissions per test
- Clean fallback messages for empty tests/questions

---

### 🧮 Evaluation System
- Automatic answer checking
- Supports multi-correct MCQs
- Marks awarded only when correct conditions are met
- Stores:
  - Total marks
  - Obtained marks
  - Per-question answers

---

## Database Highlights
- `users` – stores Admins & Students
- `tests` – quiz metadata (title, start/end time)
- `questions` – linked to tests with marks
- `options` – multiple options per question
- `submissions` – one submission per user per test
- `answers` – stores selected options & correctness

---

## UI / UX
- Built with Blade & Tailwind CSS
- Admin-only actions hidden from students
- Graceful fallback messages for:
  - No tests available
  - No questions available for this test.
  - Expired or upcoming tests

---

## Setup Instructions

1. Clone the repository  
   ```bash
    git clone https://github.com/search4asraful/quiz-evaluation.git
2. Install PHP dependencies
    ```bash
    composer install
3. Install frontend dependencies
    ```bash
    npm install && npm run dev
4. Configure environment
    ```bash
    cp .env.example .env
    php artisan key:generate
5. Configure database in .env
6. Run migrations and seeders
    ```bash
    php artisan migrate --seed
7. Update the Google OAuth credentials
8. Start the application
    ```bash
    php artisan serve