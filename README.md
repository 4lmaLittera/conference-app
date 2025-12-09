# 🎯 Conference Management System

A modern Laravel-based web application for managing conferences with a beautiful Notion-inspired UI. Built as a homework project demonstrating full-stack development capabilities with custom authentication, CRUD operations, and responsive design.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=flat&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=flat&logo=tailwind-css)

## 🛠️ Technology Stack

- **Framework**: Laravel 12.x
- **Frontend**: 
  - Tailwind CSS 3.x
  - Vite
  - SweetAlert2 (for modals)
- **Backend**: 
  - PHP 8.3
  - MySQL 8.0
- **Development**: 
  - Laravel Sail (Docker)
  - NPM/Node.js

## 📦 Installation

### Prerequisites
- Docker & Docker Compose
- Git

### Setup Instructions

1. **Clone the repository**
```bash
git clone <repository-url>
cd conference-app
```

2. **Install dependencies**
```bash
# Install Composer dependencies
./vendor/bin/sail composer install

# Install NPM dependencies
./vendor/bin/sail npm install
```

3. **Environment configuration**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
./vendor/bin/sail artisan key:generate
```

4. **Database setup**
```bash
# Create database and run migrations
./vendor/bin/sail artisan migrate:fresh --seed
```

**To reset and reseed:**
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

5. **Build assets**
```bash
# For development
./vendor/bin/sail npm run dev

# For production
./vendor/bin/sail npm run build
```

6. **Start the application**
```bash
./vendor/bin/sail up -d
```

Visit: `http://localhost`

## 👤 Default Credentials

**Admin Account:**
- **Email**: `admin@example.com`
- **Password**: `password`

## 📖 Usage

### For Guests
1. Navigate to the homepage to view all conferences
2. Click on any conference card to view details
3. Use the login link to access admin features

### For Admins
1. Login using the credentials above
2. Click "Create New" to add a conference
3. Fill in required fields:
   - Conference title
   - Description
   - Date
   - Address
   - Number of participants
4. Use edit icons on cards to modify conferences
5. Use delete icons with confirmation to remove conferences

## 🗂️ Project Structure

```
conference-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   └── ConferenceController.php
│   │   └── Requests/
│   │       ├── LoginRequest.php
│   │       ├── StoreConferenceRequest.php
│   │       └── UpdateConferenceRequest.php
│   └── Models/
│       ├── Conference.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── ConferenceSeeder.php
│       └── DatabaseSeeder.php
├── lang/
│   ├── en/
│   └── lt/ (Lithuanian)
├── resources/
│   ├── css/
│   │   └── app.css (Notion-style variables)
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── auth/
│       │   └── login.blade.php
│       ├── conferences/
│       │   ├── index.blade.php
│       │   ├── show.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── _form.blade.php
│       └── layouts/
│           └── app.blade.php
└── routes/
    └── web.php
```

## 🚀 Deployment

For production deployment:

1. Set environment variables in `.env`
2. Run migrations: `php artisan migrate --force`
3. Build assets: `npm run build`
4. Configure web server (Nginx/Apache)
5. Enable OPcache for PHP
6. Set proper file permissions

---

**Note**: This application uses Laravel Sail for local development. All commands should be prefixed with `./vendor/bin/sail` when running in the Docker environment.
