# MCQ Exam & Evaluation System

## Tech Stack
- Laravel
- Blade
- Tailwind CSS
- MySQL
- Google Authentication

## Features
### Admin
- Create MCQs
- Assign marks
- Manage questions

### Student
- Take exam
- Auto evaluation
- Instant result

## Authentication
- Email & Password
- Google Login

## Role System
Admins and Students are stored in a single `users` table using a `role` column.

## Setup
1. Clone repo
2. composer install
3. npm install && npm run dev
4. php artisan migrate --seed
5. php artisan serve
