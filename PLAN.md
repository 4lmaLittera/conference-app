# Laravel Conference Management System - Implementation Plan

**Homework Assignment | Target: 10/10 points + bonus**

---

## 📋 Quick Reference

### Admin Login
- **Email:** admin@admin.com
- **Password:** password

### Technology Stack
- **Framework:** Laravel 12
- **CSS:** Tailwind CSS (already installed ✓)
- **JavaScript:** SweetAlert2 (to install)
- **Language:** Lithuanian (UI) / English (code)
- **Build:** Vite

---

## 🎯 Points Breakdown (10+ total)

| Category | Points | Requirements |
|----------|--------|--------------|
| General | 2 | 5 GIT commits, Translation files |
| Front-end | 1 | CSS library (Tailwind), JS library (SweetAlert2) |
| Conferences CRUD | 3 | Model, Migration, Seeder, Views, Controller |
| Authentication | 3 | Login, Logout, Authorization |
| **Bonus** | +1-2 | Delete modal, Guest view, Extra fields, Daily logs |

---

## 📝 Implementation Checklist

### Phase 1: Setup & Configuration
- [ ] Install SweetAlert2: `npm install sweetalert2`
- [ ] Create git branch: `git checkout -b feature/conference-management`
- [ ] Configure `.env`: Set `APP_LOCALE=lt`
- [ ] Configure daily logs in `config/logging.php` (bonus)
- [ ] **GIT COMMIT #1:** "Initial setup: Configure environment and install dependencies"

### Phase 2: Database Layer
- [ ] Create migration: `php artisan make:migration create_conferences_table`
  - Fields: title, description, date, address, participant_count, country, city, timestamps
- [ ] Create model: `php artisan make:model Conference`
  - Add `$fillable`, `$casts` properties
- [ ] Create seeder: `php artisan make:seeder ConferenceSeeder`
  - Add 3+ sample conferences
- [ ] Update `DatabaseSeeder.php` to call ConferenceSeeder
- [ ] **GIT COMMIT #2:** "Add database structure: Conference model, migration, and seeder"

### Phase 3: Controllers & Validation
- [ ] Create controller: `php artisan make:controller ConferenceController --resource`
  - Methods: index, show, create, store, edit, update, destroy
- [ ] Create auth controller: `app/Http/Controllers/Auth/LoginController.php`
  - Methods: showLoginForm, login, logout
- [ ] Create validation: `php artisan make:request ConferenceRequest`
  - Rules for all form fields
- [ ] **GIT COMMIT #3:** "Add controllers and form validation"

### Phase 4: Routes
- [ ] Update `routes/web.php`
  - Public: /, /conferences/{id}
  - Guest: /login (GET, POST)
  - Auth: /logout, /conferences/create, store, edit, update, destroy
- [ ] Use middleware: `guest`, `auth`

### Phase 5: Views (Blade Templates)
- [ ] Create `resources/views/layouts/app.blade.php`
  - Navigation with auth-based logout button
  - Flash messages display
- [ ] Create `resources/views/auth/login.blade.php`
- [ ] Create `resources/views/conferences/index.blade.php`
  - Show create button only for auth users
  - Show edit/delete buttons only for auth users
- [ ] Create `resources/views/conferences/show.blade.php` (bonus)
- [ ] Create `resources/views/conferences/create.blade.php`
- [ ] Create `resources/views/conferences/edit.blade.php`
- [ ] Create `resources/views/conferences/_form.blade.php`
  - Reusable form partial for create/edit
- [ ] **GIT COMMIT #4:** "Add all views: layout, authentication, and conference CRUD"

### Phase 6: Translations (Lithuanian)
- [ ] Create directory: `mkdir -p lang/lt`
- [ ] Create `lang/lt/auth.php`
  - Login, logout, error messages
- [ ] Create `lang/lt/conferences.php`
  - All form labels, buttons, messages
- [ ] Create `lang/lt/validation.php`
  - Field names and validation messages
- [ ] Update `config/app.php`: Set `locale` to `lt`

### Phase 7: Front-end Assets
- [ ] Update `resources/js/app.js`
  - Import SweetAlert2
  - Add `deleteConference()` function
- [ ] Ensure Tailwind CSS is working
- [ ] **GIT COMMIT #5:** "Add translations and SweetAlert2 integration"

### Phase 8: Testing & Deployment
- [ ] Run migrations: `php artisan migrate:fresh --seed`
- [ ] Compile assets: `npm install && npm run build`
- [ ] Test as guest user
- [ ] Test as authenticated user
- [ ] Verify all translations
- [ ] Merge branch: `git checkout main && git merge feature/conference-management`

---

## 🗂️ File Structure

```
conference-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   └── LoginController.php          [NEW]
│   │   │   └── ConferenceController.php         [NEW]
│   │   └── Requests/
│   │       └── ConferenceRequest.php            [NEW]
│   └── Models/
│       ├── Conference.php                       [NEW]
│       └── User.php                             [EXISTS]
├── database/
│   ├── migrations/
│   │   └── YYYY_MM_DD_create_conferences_table.php  [NEW]
│   └── seeders/
│       ├── ConferenceSeeder.php                 [NEW]
│       └── DatabaseSeeder.php                   [MODIFY]
├── lang/
│   └── lt/                                      [NEW]
│       ├── auth.php
│       ├── conferences.php
│       └── validation.php
├── resources/
│   ├── js/
│   │   └── app.js                               [MODIFY]
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php                    [NEW]
│       ├── auth/
│       │   └── login.blade.php                  [NEW]
│       └── conferences/
│           ├── index.blade.php                  [NEW]
│           ├── show.blade.php                   [NEW - bonus]
│           ├── create.blade.php                 [NEW]
│           ├── edit.blade.php                   [NEW]
│           └── _form.blade.php                  [NEW]
└── routes/
    └── web.php                                  [MODIFY]
```

---

## 💻 Key Code Snippets

### Conference Model
```php
protected $fillable = [
    'title', 'description', 'date', 'address',
    'participant_count', 'country', 'city',
];

protected $casts = [
    'date' => 'date',
    'participant_count' => 'integer',
];
```

### Migration
```php
Schema::create('conferences', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description');
    $table->date('date');
    $table->string('address');
    $table->integer('participant_count')->nullable();
    $table->string('country', 100)->nullable();
    $table->string('city', 100)->nullable();
    $table->timestamps();
});
```

### Routes Pattern
```php
// Public
Route::get('/', [ConferenceController::class, 'index'])->name('conferences.index');
Route::get('/conferences/{conference}', [ConferenceController::class, 'show'])->name('conferences.show');

// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Auth only
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('conferences', ConferenceController::class)->except(['index', 'show']);
});
```

### SweetAlert2 Delete Function
```javascript
window.deleteConference = function(id) {
    Swal.fire({
        title: 'Ar tikrai norite ištrinti?',
        text: "Šis veiksmas negrįžtamas!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Taip, ištrinti!',
        cancelButtonText: 'Atšaukti'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
};
```

### Blade Auth Check Pattern
```blade
@auth
    <!-- Show for authenticated users -->
    <a href="{{ route('conferences.create') }}">{{ __('conferences.create_button') }}</a>
@endauth

@guest
    <!-- Show for guests -->
    <a href="{{ route('login') }}">{{ __('auth.login') }}</a>
@endguest
```

---

## ✅ Testing Checklist

### Guest User Tests
- [ ] Can view conference list at `/`
- [ ] Can view conference details (bonus feature)
- [ ] Cannot access `/conferences/create` (redirects to login)
- [ ] Cannot see edit/delete buttons
- [ ] Can access `/login` page

### Authenticated User Tests
- [ ] Can login with admin@admin.com / password
- [ ] Can see "Create Conference" button
- [ ] Can create new conference
- [ ] Form validation works (required fields, date >= today)
- [ ] Can edit existing conference
- [ ] Delete confirmation modal appears (SweetAlert2)
- [ ] Can delete conference
- [ ] Can logout
- [ ] After logout, redirected and cannot access protected pages

### Translation Tests
- [ ] All UI text is in Lithuanian
- [ ] No hardcoded English text in views
- [ ] Validation errors in Lithuanian
- [ ] Success/error messages in Lithuanian

### Technical Tests
- [ ] Tailwind CSS styles applied correctly
- [ ] SweetAlert2 modal displays properly
- [ ] No JavaScript console errors
- [ ] Assets compiled: `npm run build` succeeds
- [ ] Database seeded: `php artisan migrate:fresh --seed` works

---

## 📦 Submission Requirements

### Moodle Upload
1. Create ZIP archive of project
2. Upload ZIP to Moodle
3. Provide GIT repository link
4. Ensure 5+ commits visible
5. Ensure feature branch exists in repository

### Code Quality Checklist
- [ ] All code in English (variables, functions, classes, comments)
- [ ] All UI text in Lithuanian (via __() translations)
- [ ] PSR coding standards followed
- [ ] No hardcoded text in Blade views
- [ ] CSS/JS compiled via NPM and Vite
- [ ] .env.example updated if needed

---

## 🚀 Quick Start Commands

Every command is run in ./vendor/bin/sail

```bash
# Setup
npm install sweetalert2
git checkout -b feature/conference-management

# Create files
php artisan make:migration create_conferences_table
php artisan make:model Conference
php artisan make:seeder ConferenceSeeder
php artisan make:controller ConferenceController --resource
php artisan make:request ConferenceRequest
mkdir -p app/Http/Controllers/Auth
mkdir -p lang/lt
mkdir -p resources/views/conferences

# Run
php artisan migrate:fresh --seed
npm run dev

# Test login
# Email: admin@admin.com
# Password: password

# Deploy
npm run build
git add .
git commit -m "Complete conference management system"
git checkout main
git merge feature/conference-management
```

---

## 📚 Resources

- Laravel Documentation: https://laravel.com/docs
- Tailwind CSS: https://tailwindcss.com/docs
- SweetAlert2: https://sweetalert2.github.io
- PSR Standards: https://www.php-fig.org/psr/

---

**Last Updated:** 2025-12-04
**Status:** Ready for implementation
