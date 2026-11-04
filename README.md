# Laravel Breeze Starter (Web + Mobile & Desktop Ready)

Starter kit Laravel yang sudah terintegrasi dengan **Laravel Breeze (Blade & Alpine.js)** serta **Laravel Sanctum REST API**, dirancang untuk kebutuhan pengembangan website sekaligus backend aplikasi **Mobile (Flutter / React Native)**, **Desktop (Tauri / Electron / C#)**, dan bahan praktikum siswa **SMK Jurusan TKJ (Teknik Komputer & Jaringan)**.

---

## 🚀 Fitur Utama

- **Laravel 13 & PHP 8.4 ready**
- **Laravel Breeze (Blade + Alpine.js + Tailwind CSS)**:
  - Autentikasi Web lengkap (Login, Register, Forgot Password, Reset Password, Verify Email, Update Password).
  - Manajemen Profil User.
  - Dukungan **Dark Mode** bawaan.
- **RESTful API Siap Pakai (Laravel Sanctum)**:
  - Autentikasi berbasis Bearer Token untuk client Mobile & Desktop.
  - Endpoint: Register, Login, User Profile, dan Logout.
  - Health check endpoint `/api/ping` untuk pengujian jaringan.
- **Postman Collection Siap Pakai (`postman_collection.json`)**:
  - Tinggal import ke Postman / Thunder Client / Insomnia.
  - Otomatis menyimpan `Bearer Token` setelah login/register ke variabel koleksi.
- **Konfigurasi Database Laragon (MySQL)**:
  - Port default: `3306`, user: `root`, password: *(kosong)*.

---

## 🛠️ Prasyarat

1. **PHP >= 8.2** (Sudah tersedia di Laragon)
2. **Composer**
3. **Node.js & NPM**
4. **Laragon / MySQL Server**

---

## ⚙️ Panduan Instalasi & Menjalankan

### 1. Clone Repositori
```bash
git clone https://github.com/<username-anda>/laravel-breeze-starter.git
cd laravel-breeze-starter
```

### 2. Install Dependensi PHP & Node.js
```bash
composer install
npm install
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` ke `.env` (jika belum ada):
```bash
cp .env.example .env
php artisan key:generate
```

Pastikan konfigurasi database di file `.env` sudah sesuai dengan MySQL Laragon:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_breeze_starter
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Nyalakan Database & Jalankan Migrasi
1. Buka **Laragon**, lalu klik tombol **"Start All"** (pastikan MySQL berjalan di port 3306).
2. Jalankan perintah migrasi:
```bash
php artisan migrate
```
*(Jika database `laravel_breeze_starter` belum dibuat, Laravel akan otomatis menanyakan untuk membuatnya, ketik `yes`).*

### 5. Kompilasi Aset Frontend (Vite)
Untuk mode pengembangan:
```bash
npm run dev
```
Atau untuk build produksi:
```bash
npm run build
```

### 6. Jalankan Web Server

#### A. Akses Lokal (Komputer Sendiri)
```bash
php artisan serve
```
Buka browser di: `http://localhost:8000`

#### B. Akses Jaringan LAN / Lab SMK (Akses dari HP & Komputer Lain)
Untuk pengujian client-server di jaringan lokal lab TKJ:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```
Cek IP komputer server dengan perintah `ipconfig` (misal: `192.168.1.50`).
Client (HP Android, Laptop siswa lain) dapat mengakses via:
- Web: `http://192.168.1.50:8000`
- API: `http://192.168.1.50:8000/api/...`

---

## 📡 Daftar Endpoint API (Mobile & Desktop)

Semua request ke API wajib menyertakan header:
```http
Accept: application/json
Content-Type: application/json
```

| Method | Endpoint | Keterangan | Header Wajib |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/ping` | Tes konektivitas server & status jaringan | - |
| `POST` | `/api/register` | Mendaftarkan akun baru | - |
| `POST` | `/api/login` | Login user & mendapatkan Bearer Token | - |
| `GET` | `/api/user` | Mengambil data profil user yang login | `Authorization: Bearer <token>` |
| `POST` | `/api/logout` | Mencabut / menghapus token yang aktif | `Authorization: Bearer <token>` |

### Format Request Payload:

#### 1. Register (`POST /api/register`)
```json
{
  "name": "Siswa TKJ",
  "email": "siswa@tkj.sch.id",
  "password": "password123",
  "password_confirmation": "password123",
  "device_name": "Android-Client"
}
```

#### 2. Login (`POST /api/login`)
```json
{
  "email": "siswa@tkj.sch.id",
  "password": "password123",
  "device_name": "Android-Client"
}
```

#### 3. Response Berhasil (Login & Register)
```json
{
  "status": "success",
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "Siswa TKJ",
      "email": "siswa@tkj.sch.id"
    },
    "token": "1|abcdef123456...",
    "token_type": "Bearer"
  }
}
```

---

## 🧪 Panduan Praktik untuk Siswa TKJ

1. **Import File Postman Collection**:
   - Buka aplikasi **Postman**.
   - Klik **Import**, lalu pilih file `postman_collection.json` dari folder project ini.
   - Jalankan request berurutan: `Ping` -> `Register` -> `Login` -> `Get User` -> `Logout`.
2. **Uji Coba Pengujian Jaringan (cURL)**:
   ```bash
   curl -X GET http://127.0.0.1:8000/api/ping -H "Accept: application/json"
   ```
3. **Analisis Paket Data**:
   - Gunakan **Wireshark** atau inspect browser Network tab untuk menganalisis payload HTTP request, header, dan response JSON.

---

## 🧪 Menjalankan Automated Tests
Project ini sudah dilengkapi unit & feature test lengkap (termasuk pengujian Web dan API):
```bash
php artisan test
```

---

## 📄 Lisensi
Open-source di bawah lisensi [MIT License](LICENSE).
