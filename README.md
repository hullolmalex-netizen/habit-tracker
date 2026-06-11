# 🌱 Habit Tracker

A modern **Habit Tracker** web application built with **Laravel 12**, **Tailwind CSS**, **Laravel Breeze**, and **Chart.js**.

---

## ✨ Features

- ✅ User Authentication (Register, Login, Logout, Password Reset)
- 📋 Habit Management (Create, Edit, Delete, Categorize)
- 📅 Daily Tracking with Streak System
- 📊 Dashboard with Stats & Charts
- 📈 Statistics & Analytics
- 🗓️ Calendar View
- 🌙 Dark Mode
- 📱 Fully Responsive

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12, PHP 8.2+ |
| Frontend | Blade Templates, Tailwind CSS |
| Auth | Laravel Breeze |
| Database | MySQL |
| Charts | Chart.js |
| ORM | Eloquent |

---

## 🚀 Local Setup

### 1. Clone the repository
```bash
git clone https://github.com/hullolmalex-netizen/habit-tracker.git
cd habit-tracker
```

### 2. Install PHP dependencies
```bash
composer install
```

### 3. Install Node dependencies
```bash
npm install
```

### 4. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure your `.env` database
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=habit_tracker
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run migrations and seeders
```bash
php artisan migrate --seed
```

### 7. Build assets
```bash
npm run dev
```

### 8. Start the server
```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## 🗂️ Project Structure

```
app/
├── Http/Controllers/
│   ├── DashboardController.php
│   ├── HabitController.php
│   ├── HabitLogController.php
│   └── CategoryController.php
├── Models/
│   ├── User.php
│   ├── Habit.php
│   ├── HabitLog.php
│   └── Category.php
└── Services/
    └── StreakService.php
```

---

## 📦 Build Steps

| Step | Description | Status |
|---|---|---|
| 1 | Project setup, Tailwind, Breeze | ✅ Done |
| 2 | Database schema & models | ✅ Done |
| 3 | Auth pages & dashboard layout | ✅ Done |
| 4 | Habit CRUD | ✅ Done |
| 5 | Daily tracking & streaks | ✅ Done |
| 6 | Statistics & analytics | ✅ Done |
| 7 | Calendar feature | ✅ Done |
| 8 | UI polish & dark mode | ✅ Done |
| 9 | Testing & bug fixes | ✅ Done |
| 10 | Final optimization & deployment | ✅ Done |

---

## 📄 License

MIT License — built for learning purposes.
