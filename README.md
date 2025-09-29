# 🌐 UAS Web Development — Travel Website (PHP + MySQL)

## 📌 Deskripsi
Proyek ini adalah tugas **UAS Web Development** berupa website **Travel** berbasis **PHP dan MySQL**.  
Struktur project terdiri dari **Frontend**, **Backend (Admin Panel)**, dan **Database SQL**.  

Website ini memungkinkan:
- User melakukan booking, melihat destinasi, membaca berita, dan memberi testimoni.
- Admin mengelola data user, destinasi, berita, kategori, serta laporan booking.

---

## 💡 Fitur Utama
- Frontend (User):
  - Melihat daftar destinasi wisata
  - Membaca berita terbaru
  - Booking perjalanan
  - Memberikan testimoni
- Backend (Admin):
  - Login Admin
  - CRUD data destinasi, berita, kategori
  - Manajemen user, booking, dan testimoni
  - Dashboard dengan laporan

---

## ⚙️ Requirements
- PHP 7.4+
- MySQL / MariaDB
- Apache / Nginx
- Web server lokal (XAMPP, LAMP, Laragon, dll)

---

## 📂 Struktur Repository
- backend/ → Kode backend (Admin Panel: PHP, assets, css, js, include, dll)
- frontend/ → Kode frontend (Website user: PHP, assets, images, vendors, dll)
- sql/ → Script SQL untuk membuat database (admin.sql, berita.sql, dll)

---

**Detail file SQL:**
- admin.sql → Tabel user admin
- berita.sql → Tabel berita
- bookingmenu.sql → Tabel menu booking
- destinasi.sql → Tabel destinasi wisata
- kabupaten.sql, kecamatan.sql, provinsi.sql → Data wilayah
- kategori.sql → Kategori destinasi
- testimoni.sql → Data testimoni
- travel.sql → Data travel

---

## 🚀 Cara Menjalankan Project

### 1. Clone repository
```bash
git clone https://github.com/matwa-hub/uas-webdev-travel.git
cd uas-webdev-travel

####
