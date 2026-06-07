# 🚀 Initial Project Prompt — Wedding App (Laravel 12 Revamp)

> **Cara pakai:** Copy seluruh konten di bawah ini, paste langsung ke Claude Code di desktop kamu sebagai prompt pertama.

---

## 📋 PROMPT UNTUK CLAUDE CODE

```
Saya ingin membuat project Laravel 12 baru dari awal untuk aplikasi Wedding Invitation.
Ini adalah revamp dari project lama yang menggunakan Laravel 8.
Tolong setup project lengkap dengan struktur yang clean, modern, dan scalable.

---

## TECH STACK

- Framework     : Laravel 12 (PHP 8.2+)
- Frontend      : Blade + Livewire 3 + TailwindCSS v3
- Database      : Postgresql
- Auth          : Laravel Breeze (Livewire stack)
- Testing       : Pest PHP
- Code Quality  : Laravel Pint (formatter)
- Package       : nwidart/laravel-modules untuk modular structure

---

## LANGKAH 1 — Install Laravel 12

Jalankan perintah berikut:

```bash
composer create-project laravel/laravel wedding-app "^12.0"
cd wedding-app
```

---

## LANGKAH 2 — Install Dependencies

```bash
# Frontend & Auth
composer require laravel/breeze --dev
php artisan breeze:install livewire

# Modular Architecture
composer require nwidart/laravel-modules

# Dev Tools
composer require laravel/pint --dev
composer require laravel/telescope --dev
php artisan telescope:install

# NPM
npm install
npm run build
```

---

## LANGKAH 3 — Buat Struktur Folder Custom

Buat struktur folder berikut di dalam project:

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/           ← controller untuk panel admin
│   │   └── Guest/           ← controller untuk halaman tamu
│   ├── Middleware/
│   └── Requests/
│       ├── Admin/
│       └── Guest/
├── Models/
├── Services/                ← business logic layer
│   ├── GuestService.php
│   ├── InvitationService.php
│   └── RsvpService.php
├── Repositories/            ← database abstraction layer
│   ├── Contracts/
│   │   ├── GuestRepositoryInterface.php
│   │   └── RsvpRepositoryInterface.php
│   └── Eloquent/
│       ├── GuestRepository.php
│       └── RsvpRepository.php
├── Actions/                 ← single-purpose action classes
│   ├── Guest/
│   │   ├── CreateGuest.php
│   │   └── UpdateGuest.php
│   └── Rsvp/
│       └── SubmitRsvp.php
└── Enums/                   ← PHP 8.1+ enums
    ├── RsvpStatus.php
    └── GuestCategory.php

Modules/                     ← nwidart modules
├── Wedding/
│   ├── Http/Controllers/
│   ├── Models/
│   ├── Resources/views/
│   ├── Routes/
│   │   ├── web.php
│   │   └── api.php
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeders/
│   └── module.json
└── Guest/
    ├── Http/Controllers/
    ├── Models/
    ├── Resources/views/
    ├── Routes/
    ├── Database/
    └── module.json

resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php
│   │   ├── admin.blade.php
│   │   └── guest.blade.php
│   ├── components/
│   │   ├── ui/              ← reusable UI components
│   │   └── forms/
│   ├── pages/
│   │   ├── welcome.blade.php
│   │   └── invitation.blade.php
│   └── livewire/
│       ├── admin/
│       └── guest/
├── css/
│   └── app.css
└── js/
    └── app.js
```

---

## LANGKAH 4 — Buat File-File Core

### 4a. Enum: RsvpStatus

Buat file `app/Enums/RsvpStatus.php`:

```php
<?php

namespace App\Enums;

enum RsvpStatus: string
{
    case Pending  = 'pending';
    case Attending = 'attending';
    case NotAttending = 'not_attending';

    public function label(): string
    {
        return match($this) {
            self::Pending      => 'Menunggu Konfirmasi',
            self::Attending    => 'Hadir',
            self::NotAttending => 'Tidak Hadir',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Pending      => 'yellow',
            self::Attending    => 'green',
            self::NotAttending => 'red',
        };
    }
}
```

### 4b. Enum: GuestCategory

Buat file `app/Enums/GuestCategory.php`:

```php
<?php

namespace App\Enums;

enum GuestCategory: string
{
    case Family   = 'family';
    case Friend   = 'friend';
    case Colleague = 'colleague';
    case VIP      = 'vip';

    public function label(): string
    {
        return match($this) {
            self::Family    => 'Keluarga',
            self::Friend    => 'Teman',
            self::Colleague => 'Rekan Kerja',
            self::VIP       => 'VIP',
        };
    }
}
```

### 4c. Model: Guest

Buat file `app/Models/Guest.php`:

```php
<?php

namespace App\Models;

use App\Enums\GuestCategory;
use App\Enums\RsvpStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'category',
        'invitation_code',
        'max_attendees',
        'rsvp_status',
        'rsvp_note',
        'confirmed_at',
    ];

    protected $casts = [
        'category'     => GuestCategory::class,
        'rsvp_status'  => RsvpStatus::class,
        'confirmed_at' => 'datetime',
    ];

    public function scopeAttending($query)
    {
        return $query->where('rsvp_status', RsvpStatus::Attending);
    }

    public function scopeByCategory($query, GuestCategory $category)
    {
        return $query->where('category', $category);
    }
}
```

### 4d. Model: Rsvp

Buat file `app/Models/Rsvp.php`:

```php
<?php

namespace App\Models;

use App\Enums\RsvpStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rsvp extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'status',
        'actual_attendees',
        'message',
        'submitted_at',
        'ip_address',
    ];

    protected $casts = [
        'status'       => RsvpStatus::class,
        'submitted_at' => 'datetime',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }
}
```

---

## LANGKAH 5 — Buat Migrations

### 5a. Migration: guests table

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('category')->default('friend');
            $table->string('invitation_code')->unique();
            $table->unsignedTinyInteger('max_attendees')->default(2);
            $table->string('rsvp_status')->default('pending');
            $table->text('rsvp_note')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
```

### 5b. Migration: rsvps table

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rsvps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default('pending');
            $table->unsignedTinyInteger('actual_attendees')->default(1);
            $table->text('message')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rsvps');
    }
};
```

---

## LANGKAH 6 — Buat Service Layer

### 6a. GuestService

Buat file `app/Services/GuestService.php`:

```php
<?php

namespace App\Services;

use App\Enums\GuestCategory;
use App\Models\Guest;
use Illuminate\Support\Str;

class GuestService
{
    public function create(array $data): Guest
    {
        $data['invitation_code'] = $this->generateCode();

        return Guest::create($data);
    }

    public function update(Guest $guest, array $data): Guest
    {
        $guest->update($data);
        return $guest->fresh();
    }

    public function delete(Guest $guest): bool
    {
        return $guest->delete();
    }

    public function getStatistics(): array
    {
        return [
            'total'         => Guest::count(),
            'attending'     => Guest::attending()->count(),
            'not_attending' => Guest::where('rsvp_status', 'not_attending')->count(),
            'pending'       => Guest::where('rsvp_status', 'pending')->count(),
            'vip'           => Guest::byCategory(GuestCategory::VIP)->count(),
        ];
    }

    private function generateCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Guest::where('invitation_code', $code)->exists());

        return $code;
    }
}
```

### 6b. RsvpService

Buat file `app/Services/RsvpService.php`:

```php
<?php

namespace App\Services;

use App\Enums\RsvpStatus;
use App\Models\Guest;
use App\Models\Rsvp;
use Illuminate\Support\Facades\DB;

class RsvpService
{
    public function submit(Guest $guest, array $data): Rsvp
    {
        return DB::transaction(function () use ($guest, $data) {
            $rsvp = Rsvp::create([
                'guest_id'         => $guest->id,
                'status'           => $data['status'],
                'actual_attendees' => $data['actual_attendees'] ?? 1,
                'message'          => $data['message'] ?? null,
                'submitted_at'     => now(),
                'ip_address'       => request()->ip(),
            ]);

            $guest->update([
                'rsvp_status'  => $data['status'],
                'confirmed_at' => now(),
            ]);

            return $rsvp;
        });
    }
}
```

---

## LANGKAH 7 — Buat Routes

Edit file `routes/web.php`:

```php
<?php

use App\Http\Controllers\Guest\InvitationController;
use App\Http\Controllers\Guest\RsvpController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuestController;
use Illuminate\Support\Facades\Route;

// ── PUBLIC ROUTES ──────────────────────────────────────────────
Route::get('/', fn() => view('pages.welcome'))->name('home');

Route::prefix('invitation')->name('invitation.')->group(function () {
    Route::get('/{code}', [InvitationController::class, 'show'])->name('show');
    Route::post('/{code}/rsvp', [RsvpController::class, 'store'])->name('rsvp');
});

// ── ADMIN ROUTES ───────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('guests', GuestController::class);

    Route::get('export/guests', [GuestController::class, 'export'])->name('guests.export');
});
```

---

## LANGKAH 8 — Setup Livewire Components

Buat Livewire component untuk RSVP form:

```bash
php artisan make:livewire Guest/RsvpForm
php artisan make:livewire Admin/GuestTable
php artisan make:livewire Admin/GuestStatistics
```

---

## LANGKAH 9 — Layout Utama

Buat file `resources/views/layouts/guest.blade.php`:

```html
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Wedding Invitation</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-stone-50 text-stone-800 antialiased">
    {{ $slot }}

    @livewireScripts
</body>
</html>
```

---

## LANGKAH 10 — Setup Environment

Edit file `.env`:

```env
APP_NAME="Wedding Invitation"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=postgresql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wedding_app
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_FROM_ADDRESS="noreply@weddingapp.com"
MAIL_FROM_NAME="${APP_NAME}"

BROADCAST_CONNECTION=reverb
QUEUE_CONNECTION=database
```

---

## LANGKAH 11 — Seeder & Factory

### DatabaseSeeder

Edit `database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            GuestSeeder::class,
        ]);
    }
}
```

Lalu jalankan:

```bash
php artisan make:factory GuestFactory --model=Guest
php artisan make:seeder GuestSeeder
php artisan make:seeder AdminSeeder
```

---

## LANGKAH 12 — Jalankan Project

```bash
# Migrasi & seed database
php artisan migrate:fresh --seed

# Jalankan dev server
php artisan serve

# Di terminal terpisah
npm run dev
```

Akses aplikasi di: http://localhost:8000

---

## 📦 RINGKASAN PACKAGE YANG DIINSTALL

| Package                  | Fungsi                              |
|--------------------------|-------------------------------------|
| laravel/breeze           | Auth scaffolding (Livewire stack)   |
| livewire/livewire        | Full-stack reactive components      |
| nwidart/laravel-modules  | Modular architecture                |
| laravel/telescope        | Debug & monitoring (dev only)       |
| laravel/pint             | Code formatter PSR-12               |
| pestphp/pest             | Modern testing framework            |

---

## ✅ CHECKLIST SETELAH SETUP

- [ ] `php artisan migrate:fresh --seed` berhasil
- [ ] Halaman `/` tampil (Welcome page)
- [ ] `/admin` redirect ke login
- [ ] Halaman invitation `/invitation/{code}` tampil
- [ ] RSVP form bisa submit
- [ ] Admin dashboard menampilkan statistik tamu

---

## 🗂️ KONVENSI KODE

- **Controller** → hanya handle request/response, tidak ada logic
- **Service** → tempat business logic
- **Model** → hanya relationship, scope, cast, accessor
- **Enum** → gunakan PHP 8.1 enum untuk status dan kategori
- **Form Request** → semua validasi di sini, bukan di controller
- **Naming** → PascalCase untuk class, snake_case untuk database, camelCase untuk variable

---

> Setelah setup selesai, lanjutkan dengan membuat fitur:
> 1. Halaman undangan digital yang cantik (wedding theme)
> 2. Admin panel untuk manajemen tamu
> 3. Export data tamu ke Excel
> 4. QR Code untuk setiap undangan
> 5. WhatsApp blast untuk kirim undangan
```

---

*Generated for: Wedding-New Revamp Project*
*Stack: Laravel 12 + Livewire 3 + TailwindCSS*
*Date: Juni 2026*