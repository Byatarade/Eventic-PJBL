<div align="center">

<img src="public/eventic.svg" alt="Eventic Logo" width="80" />

# 🎟️ Eventic

**Platform Manajemen & Pembelian Tiket Event Modern**

[![Laravel](https://img.shields.io/badge/Laravel-v13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-v4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-v3-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![Filament](https://img.shields.io/badge/Filament-v5-FDAE4B?style=for-the-badge&logo=filament&logoColor=white)](https://filamentphp.com)
[![Breeze](https://img.shields.io/badge/Laravel_Breeze-v2.4-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/docs/starter-kits#laravel-breeze)
[![Vite](https://img.shields.io/badge/Vite-v8.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)

*Solusi terpadu untuk mengelola, mempromosikan, dan membeli tiket event — semua dalam satu platform yang elegan.*


</div>

---

## 📋 Deskripsi

**Eventic** adalah platform web manajemen tiket event berbasis Laravel 13 yang dirancang untuk menghubungkan **Event Organizer (EO)** dengan **pengguna/pembeli tiket**. Platform ini menghadirkan pengalaman end-to-end mulai dari pembuatan event, penjualan tiket, hingga proses pembayaran — semuanya dalam antarmuka yang modern, responsif, dan mudah digunakan.

Dibangun dengan arsitektur **multi-role** (Event Organizer, User), Eventic memastikan setiap pihak memiliki akses dan kontrol yang tepat sesuai perannya. EO mengelola event dan memantau performa secara real-time, sementara pengguna dapat mencari, membeli, dan mengelola tiket mereka dengan mudah.

---

## ✨ Fitur Unggulan

### 🎭 Untuk Pengguna (User)
| Fitur | Deskripsi |
|-------|-----------|
| 🔍 **Pencarian & Filter Event** | Temukan event berdasarkan kategori, lokasi, dan tanggal |
| 🛒 **Checkout Multi-Tiket** | Beli berbagai jenis tiket (Reguler, VIP, VVIP) dalam satu transaksi |
| 💳 **Multi Metode Pembayaran** | Dukungan GoPay, OVO, DANA, BCA VA, dan BRI VA |
| ❤️ **Wishlist Event** | Simpan event favorit dan pantau perkembangannya |
| 🎫 **Tiket Digital dengan QR Code** | Tiket digital otomatis digenerate dengan QR Code unik setelah pembayaran |
| 📜 **Riwayat Transaksi** | Pantau semua transaksi dengan filter status (Lunas / Pending / Batal) |
| 🔄 **Pengajuan Refund** | Ajukan refund dengan alasan yang terstruktur |
| 👤 **Manajemen Profil** | Update informasi akun dan ubah password dengan aman |

### 🏢 Untuk Event Organizer (EO)
| Fitur | Deskripsi |
|-------|-----------|
| 📊 **Dashboard Analytics** | Pantau total pendapatan, tiket terjual, dan event aktif secara real-time |
| 📅 **Manajemen Event Lengkap** | Buat, edit, dan publish event dengan form yang komprehensif |
| 🎟️ **Pengaturan Multi-Tiket** | Atur berbagai tipe tiket dengan harga dan stok terpisah (hingga 5 tiket/user) |
| 📋 **Daftar Peserta** | Lihat detail semua peserta yang telah membeli tiket |
| 💰 **Laporan Transaksi EO** | Monitor semua transaksi event dengan breakdown per tiket |
| 🔄 **Kelola Permintaan Refund** | Approve atau tolak permintaan refund dari pembeli |
| 📷 **Upload Banner Event** | Upload gambar banner event dengan preview langsung |
| 💼 **Profil Penyelenggara** | Kelola informasi EO termasuk sosial media (Instagram, TikTok) |

---

## 🛠️ Tech Stack

### Backend
| Teknologi | Versi | Peran |
|-----------|-------|-------|
| **PHP** | ^8.3 | Runtime bahasa utama |
| **Laravel** | ^13.0 | Framework aplikasi web |
| **Filament** | ^5.6 | Panel Dashboard UI |
| **Laravel Breeze** | ^2.4 | Autentikasi & scaffolding |
| **barryvdh/laravel-dompdf** | ^3.1 | Generate PDF tiket |
| **simplesoftwareio/simple-qrcode** | ^4.2 | Generate QR Code tiket digital |

### Frontend
| Teknologi | Versi | Peran |
|-----------|-------|-------|
| **Tailwind CSS** | ^4.2 | Utility-first CSS framework |
| **Alpine.js** | ^3.4 | Reactive UI & interaktivitas |
| **Vite** | ^8.0 | Build tool & HMR |
| **Axios** | ^1.11 | HTTP client |

### Database & Infrastruktur
| Teknologi | Peran |
|-----------|-------|
| **MySQL** | Database relasional |
| **Laravel Eloquent ORM** | Query builder & relasi model |
| **Laravel Queue** | Proses background jobs |

---

## 🚀 Cara Menjalankan Proyek

### Prasyarat
Pastikan sistem Anda telah memiliki:
- **PHP** >= 8.3
- **Composer** >= 2.x
- **Node.js** >= 18.x & **NPM**
- **MySQL**
- **Git**

### 1. Clone Repositori

```bash
git clone https://github.com/Byatarade/Eventic-PJBL.git
cd Eventic-PJBL
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

Kemudian buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventic_db
DB_USERNAME=root
DB_PASSWORD=
```

> **Tip:** Untuk development cepat, gunakan SQLite dengan mengubah `DB_CONNECTION=sqlite` dan hapus baris DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD. File database akan dibuat otomatis.

### 4. Migrasi & Seeding Database

```bash
# Jalankan migrasi
php artisan migrate

# (Opsional) Jalankan seeder untuk data dummy
php artisan db:seed
```

### 5. Install Dependensi Frontend

```bash
npm install
```

### 6. Konfigurasi Storage

```bash
# Buat symlink storage untuk akses file publik
php artisan storage:link
```

### 7. Jalankan Aplikasi

**Opsi A — Jalankan semua sekaligus (Direkomendasikan):**
```bash
composer run dev
```
> Perintah ini akan menjalankan Laravel server, Queue listener, dan Vite dev server secara bersamaan.

**Opsi B — Jalankan terpisah:**
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite asset bundler
npm run dev

# Terminal 3: Queue listener (opsional)
php artisan queue:listen
```

### 8. Akses Aplikasi

| URL | Keterangan |
|-----|-----------|
| `http://localhost:8000` | Halaman utama (Landing Page) |
| `http://localhost:8000/login` | Halaman login |
| `http://localhost:8000/register` | Halaman registrasi |
| `http://localhost:8000/dashboard` | Dashboard User |
| `http://localhost:8000/eo/dashboard` | Dashboard Event Organizer |

---

## 📁 Struktur Folder

```
Laravel-13/
├── 📁 app/
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/
│   │   │   ├── 📁 Auth/              # Autentikasi (Login, Register, dll.)
│   │   │   ├── 📁 EO/                # Controller untuk Event Organizer
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── EventController.php
│   │   │   │   └── RefundController.php
│   │   │   ├── 📁 User/              # Controller untuk User
│   │   │   │   ├── CheckoutController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── TicketController.php
│   │   │   │   ├── TransactionController.php
│   │   │   │   └── WishlistController.php
│   │   │   ├── ProfileController.php
│   │   │   └── PublicEventController.php
│   │   └── 📁 Middleware/
│   ├── 📁 Models/
│   │   ├── Event.php                 # Model Event
│   │   ├── Order.php                 # Model Transaksi/Pesanan
│   │   ├── OrderItem.php             # Model Item dalam Pesanan
│   │   ├── RefundRequest.php         # Model Permintaan Refund
│   │   ├── Ticket.php                # Model Tiket
│   │   ├── User.php                  # Model Pengguna
│   │   └── Wishlist.php              # Model Wishlist
│   └── 📁 Providers/
│
├── 📁 database/
│   ├── 📁 migrations/                # Skema database
│   ├── 📁 seeders/                   # Data awal
│   └── 📁 factories/
│
├── 📁 resources/
│   ├── 📁 css/                       # Stylesheet utama
│   ├── 📁 js/                        # JavaScript (Alpine.js, Axios)
│   └── 📁 views/
│       ├── 📁 auth/                  # View login, register
│       ├── 📁 components/            # Komponen Blade reusable
│       ├── 📁 layouts/               # Layout utama (app, sidebar, navbar)
│       ├── 📁 eo/                    # View Dashboard EO
│       │   ├── dashboard.blade.php
│       │   └── 📁 events/            # CRUD Event
│       ├── 📁 user/                  # View Dashboard User
│       │   ├── 📁 checkout/          # Alur pembelian tiket
│       │   ├── 📁 tickets/           # Manajemen tiket user
│       │   └── 📁 transactions/      # Riwayat transaksi
│       ├── 📁 events/                # Detail event publik
│       ├── 📁 profile/               # Pengaturan profil
│       ├── dashboard.blade.php       # Dashboard User utama
│       └── welcome.blade.php         # Landing Page
│
├── 📁 routes/
│   ├── web.php                       # Route web utama
│   └── auth.php                      # Route autentikasi
│
├── 📁 public/                        # Aset publik & entry point
├── 📁 storage/                       # File upload & log

├── 📁 Documentation/                 # Screenshot dokumentasi
├── .env.example                      # Template konfigurasi
├── composer.json                     # Dependensi PHP
├── package.json                      # Dependensi Node.js
├── tailwind.config.js                # Konfigurasi Tailwind CSS
└── vite.config.js                    # Konfigurasi Vite
```

---

## 🗄️ Arsitektur Database

Eventic menggunakan skema database relasional yang dioptimalkan untuk performa dan integritas data. Berikut adalah representasi visual dan detail teknis dari struktur database.

### Entity Relationship Diagram (ERD)

```mermaid
erDiagram
    USER ||--o{ EVENT : "manages (EO)"
    USER ||--o{ ORDER : "places"
    USER ||--o{ WISHLIST : "adds"
    USER ||--o{ REFUND_REQUEST : "submits"
    
    EVENT ||--o{ TICKET : "defines"
    EVENT ||--o{ WISHLIST : "bookmarked_in"
    
    TICKET ||--o{ ORDER_ITEM : "included_in"
    
    ORDER ||--|{ ORDER_ITEM : "contains"
    ORDER ||--o{ REFUND_REQUEST : "refunded_by"

    USER {
        bigint id PK
        string name
        string username
        string email
        string password
        string phone
        enum role "eo, user"
        string avatar
    }

    EVENT {
        bigint id PK
        bigint user_id FK
        string name
        text description
        string category
        string location
        datetime date
        string status
        string organizer_name
    }

    TICKET {
        bigint id PK
        bigint event_id FK
        string type "VIP, Regular, dll"
        integer price
        integer stock
        integer max_per_user
    }

    ORDER {
        bigint id PK
        bigint user_id FK
        integer total_price
        enum status "pending, paid, canceled"
        timestamp expired_at
    }

    ORDER_ITEM {
        bigint id PK
        bigint order_id FK
        bigint ticket_id FK
        integer quantity
        integer price
    }
```

### Detail Tabel Utama

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Menyimpan data autentikasi dan profil. Field `role` membedakan antara EO dan pembeli umum. |
| `events` | Entitas utama yang dikelola oleh EO. Menyimpan detail lokasi, waktu, dan metadata sosial media penyelenggara. |
| `tickets` | Definisi tipe tiket untuk setiap event. Menggunakan `unique` constraint pada kombinasi `event_id` dan `type`. |
| `orders` | Header transaksi yang mencatat status pembayaran dan batas waktu kedaluwarsa (expired). |
| `order_items` | Detail item dalam transaksi, mencatat harga saat transaksi (snapshot) untuk akurasi laporan keuangan. |
| `wishlists` | Tabel pivot yang menghubungkan pengguna dengan event yang diminati. |
| `refund_requests` | Mencatat permohonan pengembalian dana dengan alasan terstruktur dan pelacakan status oleh admin/EO. |

---

## 🔐 Keamanan & Optimasi
- **Hashing**: Semua password dienkripsi menggunakan algoritma `Bcrypt` (via Laravel native).
- **Soft Deletes**: (Opsional/Planned) Untuk menjaga jejak audit data transaksi.
- **Constraints**: Penggunaan `onDelete('cascade')` pada relasi kunci untuk menjaga integritas referensial.
- **Indexing**: Database diindeks pada kolom-kolom yang sering dicari seperti `status`, `event_id`, dan `user_id` untuk query yang lebih cepat.

---

## 📸 Dokumentasi

### 🌐 Landing Page

<table>
  <tr>
    <td align="center" width="25%">
      <img src="Documentation/Landing%20Page/Hero%20Section.jpg" width="100%" alt="Hero Section" />
      <br/><sub><b>Hero Section</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Landing%20Page/Event%20Section.jpg" width="100%" alt="Event Section" />
      <br/><sub><b>Event Section</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Landing%20Page/About%20Section.jpg" width="100%" alt="About Section" />
      <br/><sub><b>About Section</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Landing%20Page/Contact%20Section.jpg" width="100%" alt="Contact Section" />
      <br/><sub><b>Contact Section</b></sub>
    </td>
  </tr>
  <tr>
    <td align="center" width="25%">
      <img src="Documentation/Landing%20Page/Footer.jpg" width="100%" alt="Footer" />
      <br/><sub><b>Footer</b></sub>
    </td>
    <td align="center" width="25%" colspan="3"></td>
  </tr>
</table>

### 🔐 Autentikasi

<table>
  <tr>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/Login/Login.jpg" width="100%" alt="Login" />
      <br/><sub><b>Login</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/Register/Register.jpg" width="100%" alt="Register" />
      <br/><sub><b>Register</b></sub>
    </td>
    <td align="center" width="25%"></td>
    <td align="center" width="25%"></td>
  </tr>
</table>

### 🛒 Alur Pembelian Tiket

<table>
  <tr>
    <td align="center" width="20%">
      <img src="Documentation/Landing%20Page/User%20Buy/Pilih%20Kategori%20Tiket.jpg" width="100%" alt="Pilih Kategori Tiket" />
      <br/><sub><b>Pilih Kategori Tiket</b></sub>
    </td>
    <td align="center" width="20%">
      <img src="Documentation/Landing%20Page/User%20Buy/Detail%20Event.jpg" width="100%" alt="Detail Event" />
      <br/><sub><b>Detail Event</b></sub>
    </td>
    <td align="center" width="20%">
      <img src="Documentation/Landing%20Page/User%20Buy/Detail%20Pesanan.jpg" width="100%" alt="Detail Pesanan" />
      <br/><sub><b>Detail Pesanan</b></sub>
    </td>
    <td align="center" width="20%">
      <img src="Documentation/Landing%20Page/User%20Buy/Metode%20Pembayaran.jpg" width="100%" alt="Metode Pembayaran" />
      <br/><sub><b>Metode Pembayaran</b></sub>
    </td>
    <td align="center" width="20%">
      <img src="Documentation/Landing%20Page/User%20Buy/Pembayaran%20Done.jpg" width="100%" alt="Pembayaran Berhasil" />
      <br/><sub><b>Pembayaran Berhasil</b></sub>
    </td>
  </tr>
</table>

### 👤 Dashboard Pengguna (User)

<table>
  <tr>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/User/Home.jpg" width="100%" alt="Dashboard User - Home" />
      <br/><sub><b>Beranda User</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/User/Tiket.jpg" width="100%" alt="Dashboard User - Tiket" />
      <br/><sub><b>Tiket Saya</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/User/Transaksi.jpg" width="100%" alt="Dashboard User - Transaksi" />
      <br/><sub><b>Riwayat Transaksi</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/User/Wishlist.jpg" width="100%" alt="Dashboard User - Wishlist" />
      <br/><sub><b>Wishlist Event</b></sub>
    </td>
  </tr>
  <tr>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/User/Pengaturan%20Profil.jpg" width="100%" alt="Dashboard User - Profil" />
      <br/><sub><b>Pengaturan Profil</b></sub>
    </td>
    <td align="center" width="25%" colspan="3"></td>
  </tr>
</table>

### 🏢 Dashboard Event Organizer (EO)

<table>
  <tr>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/EO/Home.jpg" width="100%" alt="Dashboard EO - Home" />
      <br/><sub><b>Beranda EO</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/EO/Manajemen%20Event.jpg" width="100%" alt="Manajemen Event" />
      <br/><sub><b>Manajemen Event</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/EO/Peserta%20Event.jpg" width="100%" alt="Peserta Event" />
      <br/><sub><b>Peserta Event</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/EO/Transaksi.jpg" width="100%" alt="Transaksi EO" />
      <br/><sub><b>Transaksi EO</b></sub>
    </td>
  </tr>
  <tr>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/EO/Keuntungan.jpg" width="100%" alt="Keuntungan EO" />
      <br/><sub><b>Laporan Keuntungan</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/EO/Kelola%20Refund.jpg" width="100%" alt="Kelola Refund" />
      <br/><sub><b>Kelola Refund</b></sub>
    </td>
    <td align="center" width="25%">
      <img src="Documentation/Dashboard/EO/Pengaturan%20Profil.jpg" width="100%" alt="Profil EO" />
      <br/><sub><b>Pengaturan Profil EO</b></sub>
    </td>
    <td align="center" width="25%"></td>
  </tr>
</table>



## 🤝 Kontribusi

Kontribusi sangat disambut! Silakan ikuti langkah berikut:

1. **Fork** repositori ini
2. Buat **branch** fitur baru: `git checkout -b feature/NamaFitur`
3. **Commit** perubahan: `git commit -m 'feat: tambah fitur keren'`
4. **Push** ke branch: `git push origin feature/NamaFitur`
5. Buat **Pull Request**

> Harap ikuti konvensi commit [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/).

---

<div align="center">

Dibuat dengan &nbsp;
![Laravel](https://img.shields.io/badge/Laravel-v13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)
&nbsp; dan &nbsp;
![Vite](https://img.shields.io/badge/Vite-v8.x-646CFF?style=flat-square&logo=vite&logoColor=white)

Created by Byatarade. ig: @byatarade

</div>