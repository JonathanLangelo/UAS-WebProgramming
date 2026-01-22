# 🎬 CinePlex - Ultimate Movie Trailer Showcase

CinePlex adalah platform showcase trailer film modern yang dibangun dengan **Laravel** dan didesain dengan estetika **Cyberpunk/Futuristic**. Proyek ini bertujuan untuk memberikan pengalaman menjelajahi film yang imersif dan interaktif.

## ✨ Fitur Utama

- **Premium Cinematic UI**: Desain futuristik dengan efek glassmorphism, animasi neon, dan font Orbitron.
- **Movie Catalog**: Daftar film lengkap dengan kategori Trending dan Genre.
- **Dynamic Search**: Cari film favorit Anda dengan cepat dan mudah.
- **Advanced Trailer Modal**: Tonton trailer film langsung dari aplikasi dengan modal yang elegan.
- **Related Movies**: Rekomendasi film serupa berdasarkan genre.
- **Mobile Responsive**: Pengalaman yang mulus di perangkat mobile maupun desktop.

## 🚀 Tech Stack

- **Backend**: [Laravel 12](https://laravel.com)
- **Frontend**: [Tailwind CSS](https://tailwindcss.com), [Vanilla JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
- **Database**: [SQLite](https://www.sqlite.org/index.html) (Default)
- **Icons & Fonts**: [Font Awesome 6](https://fontawesome.com), [Google Fonts (Orbitron & Inter)](https://fonts.google.com)
- **Build Tool**: [Vite](https://vitejs.dev)

## 🛠️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin lokal Anda:

1. **Clone repositori**:
   ```bash
   git clone [url-repository]
   cd movie-trailer-showcase
   ```

2. **Setup Proyek (Otomatis)**:
   Kami telah menyediakan script setup untuk memudahkan Anda:
   ```bash
   composer run setup
   ```
   *Script ini akan menginstal dependensi (Composer & NPM), menyalin file `.env`, generate key, melakukan migrasi database, dan menjalankan build frontend.*

3. **Jalankan Server**:
   ```bash
   composer run dev
   ```

### Admin Access

Untuk mengakses halaman admin, gunakan kredensial default berikut:
- **URL**: `/admin`
- **Email**: `admin@cineplex.com`
- **Password**: `password123`

> [!NOTE]  
> Pastikan Anda telah menjalankan `composer run setup` agar akun admin ini terbuat otomatis di database.

## 📂 Struktur Proyek

- `app/Http/Controllers/MovieController.php`: Logika utama untuk menampilkan film, genre, dan pencarian.
- `app/Models/Movie.php`: Model database dengan scope filter dan trending.
- `resources/views/`: File template Blade untuk tampilan UI.
- `resources/css/app.css`: Konfigurasi styling dan sistem desain.
- `database/seeders/`: Data awal untuk mengisi katalog film.

## 📝 Catatan Pengembangan

Proyek ini dikembangkan sebagai bagian dari tugas Web Programming UTS/UAS oleh:
**Jonathan Immanuel Mazar Langelo**

---

<p align="center">
  Dibuat dengan ❤️ untuk pecinta film.
</p>
