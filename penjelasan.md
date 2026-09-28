# 📖 Analisis Lengkap Website KEMUDI LMS (CandyRedis2)

> **Nama Aplikasi:** KEMUDI — *Kelas Elektronik & Manajemen Ujian Digital Interaktif*  
> **Nama Internal / Engine:** CandyRedis2 (Edisi Redis)  
> **Dibuat oleh:** Nusa Garuda Studio  
> **Teknologi:** PHP Native + CodeIgniter 3 (portal guru), MySQL, jQuery, AdminLTE, Bootstrap 3  
> **Database:** `candy_redis`

---

## 📋 Daftar Isi

1. [Gambaran Umum Sistem](#1-gambaran-umum-sistem)
2. [Arsitektur & Struktur Proyek](#2-arsitektur--struktur-proyek)
3. [Landing Page (Halaman Publik)](#3-landing-page-halaman-publik)
4. [Halaman Publik Lainnya](#4-halaman-publik-lainnya)
5. [Sistem Login & Otentikasi](#5-sistem-login--otentikasi)
6. [Dashboard Siswa](#6-dashboard-siswa)
7. [Modul Ujian CBT Siswa](#7-modul-ujian-cbt-siswa)
8. [Dashboard Guru (Portal Guru)](#8-dashboard-guru-portal-guru)
9. [Dashboard Admin (Crew)](#9-dashboard-admin-crew)
10. [Fitur Pendukung Lainnya](#10-fitur-pendukung-lainnya)
11. [Peta Navigasi (Sitemap)](#11-peta-navigasi-sitemap)
12. [Ringkasan Tabel Fitur per Role](#12-ringkasan-tabel-fitur-per-role)

---

## 1. Gambaran Umum Sistem

KEMUDI adalah **platform Learning Management System (LMS) & Computer-Based Test (CBT)** yang dirancang khusus untuk kebutuhan **sekolah formal (SD/SMP/SMA/SMK)** dan **lembaga bimbingan belajar** di Indonesia.

### Fungsi Utama:
- **Ujian Online (CBT)** — Pilihan Ganda, Esai, dan Campuran (PG + Esai)
- **E-Learning** — Distribusi materi pelajaran digital
- **Presensi Digital** — Absen sekolah dan absen per mata pelajaran
- **Manajemen Tugas** — Pemberian dan pengumpulan tugas siswa
- **Manajemen Kelas & Siswa** — Data master siswa, kelas, jurusan
- **Buku Nilai Digital** — Rekap otomatis hasil ujian, ekspor ke Excel
- **Pengumuman** — Distribusi informasi ke siswa

### Tiga Role Utama:
| Role | Portal | Akses |
|------|--------|-------|
| **Siswa** | `index.php` (root) | Ujian, Absen, Materi, Tugas, Hasil Nilai |
| **Guru** | `guru/` (CodeIgniter 3) | Bank Soal, Materi, Tugas, Download Nilai, Status Peserta, Analisa Soal |
| **Admin** | `crew/` (PHP Native) | Seluruh manajemen sistem: Siswa, Guru, Mapel, Ujian, Jadwal, Kelas, Setting, Backup |

---

## 2. Arsitektur & Struktur Proyek

```
candyredis2/
├── index.php              <- Entry point utama (siswa dashboard + landing)
├── landing.php            <- Konten halaman landing (home publik)
├── landing_header.php     <- Header + Navbar publik
├── landing_footer.php     <- Footer + Login Modal + JS
├── style.css              <- Stylesheet landing page (~42KB)
│
├── about.php              <- Halaman About Us
├── features.php           <- Halaman Fitur
├── pricing.php            <- Halaman Pricing
├── careers.php            <- Halaman Karir
├── contact.php            <- Halaman Kontak
│
├── login.php              <- Halaman login siswa (legacy/fallback)
├── ceklogin.php           <- Handler login AJAX siswa
├── logout.php             <- Handler logout
│
├── soal.php               <- Render soal Pilihan Ganda
├── soalesai.php           <- Render soal Esai
├── soalpgesai.php         <- Render soal PG + Esai (campuran)
├── c_jawaban.php          <- Controller jawaban (simpan, kirim, proses nilai)
├── konfirmasi.php         <- Halaman konfirmasi sebelum memulai ujian
│
├── absen.php              <- Modul absen sekolah
├── absen_mapel.php        <- Modul absen per mata pelajaran
├── materi.php             <- Modul materi belajar siswa
├── tugas.php              <- Modul tugas siswa
├── lihattugas.php         <- Lihat detail tugas
├── pengumuman.php         <- Modul pengumuman
├── pass.php               <- Modul ganti password siswa
├── hhasil.php             <- Halaman daftar hasil ujian
├── hlihathasil.php        <- Halaman detail lihat hasil ujian
│
├── config/                <- Konfigurasi database, fungsi, constants
│   ├── config.candy2.php  <- Definisi nama aplikasi, versi, database
│   ├── config.function.php
│   ├── functions.crud.php
│   └── setting_database.php
│
├── guru/                  <- Portal Guru (CodeIgniter 3)
│   ├── index.php          <- CI3 front controller
│   └── application/
│       └── views/
│           ├── home.php           <- Dashboard guru
│           └── thema/
│               └── sidebar_menu.php <- Sidebar navigasi guru
│
├── crew/                  <- Portal Admin (PHP Native, 2959 baris!)
│   ├── index.php          <- Mega-file admin dashboard
│   ├── login.php          <- Login admin
│   ├── banksoal.php       <- Manajemen bank soal (~85KB)
│   └── ... (100+ file admin)
│
├── dist/                  <- Assets (AdminLTE, Bootstrap, CSS)
├── plugins/               <- jQuery plugins (DataTables, SweetAlert2, MathJax, dll.)
├── image/                 <- Gambar landing page
├── foto/                  <- Foto siswa
├── files/                 <- File upload (materi, tugas)
└── vendor/                <- Composer dependencies
```

---

## 3. Landing Page (Halaman Publik)

> **File:** `landing.php` — Ditampilkan jika siswa **belum login**

Landing page menampilkan keseluruhan informasi produk KEMUDI dalam satu halaman panjang (one-page scroll) dengan desain modern dan animasi scroll-reveal.

### Struktur Seksi Landing Page:

| # | Seksi | Deskripsi |
|---|-------|-----------|
| 1 | **Hero Section** | Banner utama: "Studying Online is now much easier", tagline KEMUDI, CTA "Join for free" + "Watch how it works". Terdapat floating cards animasi (250k Assisted Student, Congratulations card, User Experience Class). |
| 2 | **Our Success** | Statistik pencapaian: 15K+ Students, 75% Total Success, 35 Main Questions, 26 Chief Experts, 16 Years Experience. Counter animasi saat scroll. |
| 3 | **All-In-One Cloud Software** | 3 kartu fitur: Online Billing & Contracts, Easy Scheduling & Attendance, Customer Tracking. |
| 4 | **What is KEMUDI?** | Dua kartu: FOR INSTRUCTORS ("Start a class today") dan FOR STUDENTS ("Enter access code"). |
| 5 | **Physical Classroom Comparison** | Perbandingan kelas fisik vs. digital KEMUDI dengan gambar presentasi kelas. |
| 6 | **Our Features (UI Design)** | Mock-up video grid (Instructor, Siswa A, Siswa B). 3 Fitur: Dedicated Podium Space, Co-Host Control, Real-time Student Monitoring. |
| 7 | **Tools for Teachers & Learners** | Checklist fitur: Papan Tulis Digital, Sistem Breakout Rooms, Chat Kelas & File Sharing. |
| 8 | **Assessments, Quizzes, Tests** | Mock kartu kuis interaktif. Deskripsi fitur acak soal, batas waktu, dan auto-grading. |
| 9 | **Class Management Tools** | Mock "GradeBook" dengan bar progress dan skor siswa (Siti Rahayu: 90, Budi Santoso: 75, Anita Wijaya: 85). |
| 10 | **One-on-One Discussions** | Mock video diskusi guru-siswa. Fitur diskusi privat di luar kelas utama. |
| 11 | **About Us** | 10+ Tahun Inovasi Pendidikan, Inovasi Berkelanjutan, Keamanan & Integritas. |
| 12 | **Pricing (3 Paket)** | Bimbel (Rp 99.000/bulan), School (Rp 5.000/siswa/semester), Custom (Hubungi Kami). |
| 13 | **Careers** | 3 lowongan: Frontend Developer, UI/UX Designer, Education Consultant. |
| 14 | **Contact** | Email, WhatsApp, Instagram. CTA ke halaman kontak detail. |

### Elemen Visual Landing Page:
- **Wave divider SVG** antara hero dan konten
- **Scroll Reveal animations** (IntersectionObserver)
- **Counter animation** pada statistik
- **Floating cards** animasi di hero section
- **Responsive navbar** dengan efek scroll (transparan -> solid)

---

## 4. Halaman Publik Lainnya

### 4.1 About Us (`about.php`)
- **Page Hero**: "Mengubah Masa Depan Pendidikan Indonesia"
- **Visi & Misi**: Platform cloud #1 di Indonesia; Perkakas kelas virtual anti-curang
- **Nilai Utama**: Fokus Guru & Siswa, Integritas Kejujuran Akademik, Aksesibilitas Luas (optimasi jaringan minim)
- **Tim Leadership**: Sashi Kirana (Educational Advisor), Muhammad Rizki (Head of UX Design), Joseph (Head of UX Design)

### 4.2 Features (`features.php`)
- **Page Hero**: "Semua Fitur Kelas & Ujian Dalam Satu Platform"
- **All-In-One Cloud Software** (duplikat dari landing — konsistensi branding)
- **UI Design for Classroom**: Dedicated Podium, Co-Host Control, Real-time Monitoring
- **Class Management Tools**: Mock GradeBook dengan fungsi Export

### 4.3 Pricing (`pricing.php`)
- **Page Hero**: "Skalakan Pembelajaran dengan Rencana Fleksibel"
- **3 Paket Berlangganan:**

| Paket | Harga | Target |
|-------|-------|--------|
| **KEMUDI LMS For Bimbel** | ~~Rp 149.000~~ **Rp 99.000**/bulan | Bimbingan belajar (maks 50 siswa) |
| **KEMUDI LMS For School** (POPULER) | **Rp 5.000**/siswa/semester | Sekolah formal SMP/SMA/SMK |
| **KEMUDI LMS Custom** | Hubungi Kami | Enterprise (custom domain, white-label) |

- **FAQ Section**: Biaya tersembunyi, Metode pembayaran, Kebijakan upgrade/downgrade

### 4.4 Careers (`careers.php`)
- **Page Hero**: "Bangun Masa Depan EdTech Indonesia"
- **Why Join Us**: Kerja Fleksibel (WFA), Asuransi Kesehatan, Dana Pengembangan Diri
- **3 Lowongan Aktif**: Frontend Developer (Jakarta/Remote), UI/UX Designer (Remote), Education Consultant (Bandung)
- **Lamaran Umum**: CTA untuk kirim CV jika posisi tidak cocok

### 4.5 Contact (`contact.php`)
- **Page Hero**: "Mari Mulai Bekerjasama"
- **Informasi Kontak**: Gedung EdTech Indonesia Lt. 3, Jl. Asia Afrika No. 12, Bandung
- **Telepon/WA**: +62 878-9760-0086
- **Email**: sales@kemudilms.my.id / support@kemudilms.my.id
- **Jam Operasional**: Senin-Jumat 08:00-17:00 WIB
- **Map Mock** (placeholder visual) + **Social Media Links** (Facebook, Instagram, LinkedIn)
- **Saluran Kontak Langsung**: 4 kartu klik (WhatsApp Sales, WhatsApp Support, Email Kemitraan, Instagram DM)

---

## 5. Sistem Login & Otentikasi

### Login Modal (di Landing Page)
> **File:** `landing_footer.php` (baris 28-95)

Login dilakukan melalui **modal popup** yang muncul saat klik tombol "Login" di navbar. Terdapat **3 tab**:

| Tab | Cara Login | Tujuan |
|-----|-----------|--------|
| **Siswa** | Form AJAX (username + password) -> `ceklogin.php` | Dashboard siswa (`index.php`) |
| **Guru** | Redirect button -> `guru/` | Portal guru (CodeIgniter 3) |
| **Admin** | Redirect button -> `crew/` | Portal admin (PHP native) |

### Respons Login Siswa:
| Kode | Artinya |
|------|---------|
| `ok` | Login berhasil, redirect ke dashboard |
| `nopass` | Password salah |
| `td` | Siswa tidak terdaftar |
| `nologin` | Siswa sudah aktif (login di tempat lain) |

### Fitur Keamanan:
- Mode **Maintenance** (`LoginSiswaMainten == 1`): Form diganti pesan maintenance
- Session-based authentication per role
- Cek tabel `pengawas` untuk redirect ke install jika database belum setup

---

## 6. Dashboard Siswa

> **File:** `index.php` (baris 472-714)

### Layout Dashboard:
- **Framework UI**: AdminLTE + Bootstrap 3 dengan custom theme "JawaraCBT"
- **Sidebar**: Menu navigasi utama (collapsible)
- **Topbar/Navbar**: Logo sekolah, nama sekolah, user dropdown

### Komponen Dashboard Utama:

#### Hero Banner
- Banner kampus dengan overlay "Selamat Datang, [Nama Siswa]"
- Info kelas dan sekolah
- **Search Bar** global: Filter card dashboard berdasarkan keyword

#### 6 Stat Cards (Main Content Grid)
| Card | Informasi |
|------|-----------|
| **Status Siswa** | AKTIF / OFF, status verifikasi akun |
| **Active Exams** | CBT Ready, Sesi ujian, Nomor ruang |
| **Presensi** | Status absensi sekolah & mapel hari ini |
| **Materi Belajar** | E-Learning, modul ajar dari guru |
| **Tugas Terstruktur** | Latihan & tugas terstruktur |
| **Hasil Ujian** | Nilai, rekap skor CBT |

#### Quick Actions Panel (Sidebar Kanan)
- **Mulai Ujian Sekolah** (primary action, disabled jika ujian belum aktif)
- Absen Sekolah
- Absen Mapel
- Materi Pelajaran
- Tugas Siswa
- Hasil Ujian

#### Bottom Cards
1. **Petunjuk Ujian & Pengumuman**: 4 poin aturan ujian
2. **Identitas Peserta Ujian**: Username, NISN, Kelas & Jurusan, Sesi & Ruangan

### Menu Sidebar Siswa:

| Kategori | Menu | Kondisi Tampil |
|----------|------|----------------|
| GENERAL | Overview (Dashboard) | Selalu |
| | Ujian Sekolah | `izin_ujian == 1` |
| | Hasil Ujian | `izin_ujian == 1` |
| | Absen Sekolah | `izin_absen == 1` |
| | Absen Mapel | `izin_absen_mapel == 1` |
| | Materi Belajar | `izin_materi == 1` |
| | Tugas Siswa | `izin_tugas == 1` |
| OTHERS | Pengumuman | `izin_info == 1` |
| | Ganti Password | `izin_pass == 1` |
| | Exambro APK | Selalu (download `.apk`) |

---

## 7. Modul Ujian CBT Siswa

> **File:** `index.php` (baris 715-1031) — mode `testongoing`

### Alur Ujian:

```
Dashboard Siswa -> Halaman Ujian (Jadwal) -> Konfirmasi Ujian -> Masuk Mode CBT (Fullscreen) -> Kerjakan Soal -> Selesai / Waktu Habis -> Proses Nilai Otomatis -> Kembali ke Dashboard
```

### Halaman Jadwal Ujian (`pg == 'ujian'`):
- Tabel jadwal ujian hari ini (No, Aksi, Nama Ujian, Tanggal Mulai, Tanggal Selesai)
- Tombol "Mulai" aktif hanya jika jadwal sudah masuk waktu
- Informasi paket soal siswa

### Mode Ujian Berlangsung (`pg == 'testongoing'`):
- **Navbar disembunyikan** & **sidebar di-collapse** untuk fokus
- **Fullscreen mode** — otomatis masuk fullscreen setelah konfirmasi
- **SweetAlert2 Dialog**: "Peraturan Ujian - Kerjakan soal dengan benar dan teliti, Dilarang Mencontek"
- **Tombol Back History disabled** — mencegah siswa kembali

### 3 Jenis Soal yang Didukung:
| Jenis | File | Keterangan |
|-------|------|------------|
| **Pilihan Ganda (PG)** | `soal.php` | Soal PG standar |
| **Esai** | `soalesai.php` | Soal jawaban panjang |
| **PG + Esai (Campuran)** | `soalpgesai.php` | Kombinasi PG dan esai |

### Fitur Ujian:
- **Timer countdown** (Jam:Menit:Detik) — warna merah jika < 18 menit
- **Mode Gelap/Terang** (toggle switch)
- **Fullscreen toggle** button
- **Navigasi soal** via modal tombol nomor soal
- **Auto-save jawaban** setiap **5 menit** (interval 300.000ms)
- **Kirim jawaban saat selesai** dengan konfirmasi jumlah terkirim vs belum
- **Waktu habis otomatis** -> auto-submit semua jawaban + proses nilai
- **localStorage** untuk menyimpan jawaban sementara (offline-safe)
- **MathJax** support untuk rumus matematika
- **Font size adjustable** (disimpan di localStorage)
- **Zoom gambar** pada soal

---

## 8. Dashboard Guru (Portal Guru)

> **Lokasi:** `guru/` — Menggunakan **CodeIgniter 3**  
> **File dashboard:** `guru/application/views/home.php`  
> **File sidebar:** `guru/application/views/thema/sidebar_menu.php`

### Layout Dashboard Guru:
Mirip dengan dashboard siswa (JawaraCBT theme), tetapi konten disesuaikan untuk **guru/tenaga pendidik**.

### Komponen Dashboard Guru:

#### Hero Banner
- Banner kampus: "[Nama Sekolah]"
- Subtitle: "[Nama Aplikasi] - Portal Guru & Tenaga Pendidik"
- Search bar global

#### 4 Stat Cards:
| Card | Informasi |
|------|-----------|
| **Total Students** | Jumlah siswa aktif terdaftar |
| **Materi Pembelajaran** | Total bahan ajar yang diunggah (diambil via AJAX JSON) |
| **Tugas Terstruktur** | Total tugas & latihan siswa (diambil via AJAX JSON) |
| **Bank Soal & Ujian** | Status CBT Ready, manajemen soal |

#### Quick Actions Guru:
- **Kelola Bank Soal** (primary action)
- Materi Belajar
- Tugas Siswa
- Download Nilai
- Status Peserta Ujian
- Clear Cache

#### Informasi Sekolah & Kontak:
- Nama Sekolah, Alamat, Telepon, Email

### Menu Sidebar Guru:

| Kategori | Menu | Sub-menu |
|----------|------|----------|
| GENERAL | Overview | - |
| | Data Siswa | - |
| | E-Learning | Materi Belajar, Tugas Siswa |
| | Bank Soal | Daftar Soal Ujian |
| | Download Nilai | - |
| | Status Peserta | - |
| OTHERS | Analisa | Analisa Per Soal |
| | Siswa Tidak Ujian | - |

---

## 9. Dashboard Admin (Crew)

> **Lokasi:** `crew/`  
> **File utama:** `crew/index.php` (~2959 baris, 111KB — mega-file)

Admin dashboard adalah pusat kendali utama seluruh sistem KEMUDI. Menggunakan PHP native murni tanpa framework.

### Daftar Halaman Admin (45+ modul berdasarkan `$pg`):

| # | `$pg` | Fungsi |
|---|-------|--------|
| 1 | `''` (kosong) | Dashboard utama admin |
| 2 | `dataserver` | Info server & sistem |
| 3 | `sinkrondapo` | Sinkronisasi data Dapodik |
| 4 | `sinkron` | Sinkronisasi data umum |
| 5 | `sinkronset` | Setting sinkronisasi |
| 6 | `informasi` | Info pengumuman |
| 7 | `dataujian` | Data & jadwal ujian |
| 8-9 | `filemanager` / `filemanager2` | Manajemen file |
| 10 | `matapelajaran` | Master mata pelajaran |
| 11 | `token` | Manajemen token ujian |
| 12 | `pengumuman` | CRUD pengumuman |
| 13 | `guru` | Manajemen data guru |
| 14 | `beritaacara` | Berita acara ujian |
| 15 | `jadwal` | Penjadwalan ujian |
| 16 | `berita` | Manajemen berita |
| 17-18 | `nilai` / `nilai2` | Manajemen nilai |
| 19 | `semuanilai` | Rekap semua nilai |
| 20 | `susulan` | Ujian susulan |
| 21-22 | `status` / `status2` | Status peserta ujian |
| 23 | `kartu` | Cetak kartu ujian |
| 24 | `dena` | Denah lokasi duduk |
| 25 | `absen` | Manajemen absensi |
| 26 | `siswa` | Master data siswa |
| 27 | `uplfotosiswa` | Upload foto siswa |
| 28 | `importmaster` | Import data master |
| 29 | `importguru` | Import data guru |
| 30 | `pengawas` | Manajemen pengawas ujian |
| 31 | `pk` | Paket Keahlian / Jurusan |
| 32 | `jenisujian` | Jenis ujian |
| 33 | `ruang` | Master ruang ujian |
| 34 | `level` | Level/tingkat kelas |
| 35 | `sesi` | Sesi ujian |
| 36 | `kelas` | Master data kelas |
| 37 | `banksoal` | Bank soal utama |
| 38 | `editguru` | Edit data guru |
| 39 | `reset` | Reset data |
| 40 | `pengacak` | Pengaturan pengacak soal |
| 41 | `pengaturan` | Setting global aplikasi |
| 42 | `block` | Blokir siswa |
| 43 | `siswa_kelas` | Data siswa per kelas |
| 44 | `anso` | Analisa soal |
| 45 | `anso_nilai` | Analisa nilai |
| — | `data_cleanup` | Pembersihan data (khusus admin level "admin") |

### Fitur Keamanan Admin:
- Halaman **Data Cleanup** dilindungi **strict authorization** — hanya akses `$_SESSION['level'] === 'admin'`
- Halaman 403 Forbidden khusus jika non-admin mencoba mengakses

### File Pendukung Admin (100+ file):
- **Import/Export Excel**: `import_siswa.php`, `import_soal.php`, `ekspor_siswa.php`, `ekspor_soal.php`
- **Report Excel**: `report_excel.php`, `report_excel_absen_bulan.php`, `report_excel_esai.php`, dll.
- **Bank Soal**: `banksoal.php` (~85KB), `simpansoal.php`, `duplikat_soal.php`
- **Cetak**: `cetak_absen.php`, `cetak_kartu2.php`, `cetak_tugas.php`, `cetaksoal.php`, `cetaksoal_kunci.php`
- **Backup**: `backup.php`, `restore.php`, `backup_file_json.php`, `backup_restor_json.php`
- **Telegram Bot Integration**: `telegram/` directory

---

## 10. Fitur Pendukung Lainnya

### Exambro Client
- **File APK**: `brocandycbt.apk` (2.3MB) — Browser khusus CBT untuk Android
- **File PC**: `Exambro-Client PC.zip` (354KB) — Client browser ujian untuk PC
- Mengunci perangkat saat ujian berlangsung

### Auto Absen Sekolah
- **File:** `auto_absen_sekolah.php` — Otomasi presensi sekolah

### Bot Integration
- **Direktori:** `bot/` — Integrasi bot (kemungkinan Telegram)

### Cache System
- **File:** `cache.php`, `class_cache.php` — Sistem caching untuk performance

### Fitur Mode Tampilan per Jenjang:
Warna sidebar berubah berdasarkan setting jenjang sekolah:
| Jenjang | Warna Sidebar |
|---------|---------------|
| SD | Merah (`#c74230`) |
| SMP | Biru (`#0030a7`) |
| SMK | Gradient Teal |
| Lainnya | Hijau Teal (`#00a896`) |

### Setting On/Off Fitur:
Semua fitur dapat diaktifkan/nonaktifkan oleh admin melalui tabel `setting`:

| Setting Key | Fitur yang Dikontrol |
|-------------|---------------------|
| `izin_ujian` | Modul Ujian Sekolah & Hasil |
| `izin_absen` | Modul Absen Sekolah |
| `izin_absen_mapel` | Modul Absen Mapel |
| `izin_materi` | Modul Materi Belajar |
| `izin_tugas` | Modul Tugas Siswa |
| `izin_info` | Modul Pengumuman |
| `izin_pass` | Modul Ganti Password |
| `LoginSiswaMainten` | Mode Maintenance Login |

---

## 11. Peta Navigasi (Sitemap)

```
KEMUDI LMS — Peta Navigasi

index.php (Entry Point)
├── [Belum Login] -> Landing Page
│   ├── about.php
│   ├── features.php
│   ├── pricing.php
│   ├── careers.php
│   ├── contact.php
│   └── Login Modal
│       ├── Tab Siswa  -> Dashboard Siswa
│       ├── Tab Guru   -> guru/ (CI3)
│       └── Tab Admin  -> crew/ (Admin)
│
├── [Sudah Login Siswa] -> Dashboard Siswa
│   ├── Ujian Sekolah
│   │   ├── Konfirmasi Ujian
│   │   └── Mode CBT (Fullscreen)
│   │       └── Soal PG / Esai / Campuran
│   │           └── Proses Nilai
│   ├── Hasil Ujian
│   ├── Absen Sekolah
│   ├── Absen Mapel
│   ├── Materi Belajar
│   ├── Tugas Siswa
│   ├── Pengumuman
│   └── Ganti Password
│
├── guru/ (Portal Guru - CodeIgniter 3)
│   ├── Overview Dashboard
│   ├── Data Siswa
│   ├── E-Learning (Materi + Tugas)
│   ├── Bank Soal
│   ├── Download Nilai
│   ├── Status Peserta
│   ├── Analisa Soal
│   └── Siswa Tidak Ujian
│
└── crew/ (Portal Admin - PHP Native)
    ├── Dashboard Admin
    ├── Master Data (Siswa/Guru/Kelas/Mapel/Jurusan)
    ├── Manajemen Ujian & Jadwal
    ├── Bank Soal
    ├── Absensi
    ├── Pengaturan Sistem
    ├── Import/Export Data
    ├── Backup & Restore
    └── Data Cleanup (Admin Only)
```

---

## 12. Ringkasan Tabel Fitur per Role

| Fitur | Siswa | Guru | Admin |
|-------|:-----:|:----:|:-----:|
| Dashboard Overview | Ya | Ya | Ya |
| Ujian CBT (PG/Esai/Campuran) | Ya | — | Ya (kelola) |
| Bank Soal (CRUD) | — | Ya | Ya |
| Jadwal Ujian | Lihat | — | Ya (kelola) |
| Materi Belajar | Unduh | Upload | Ya |
| Tugas Siswa | Kerjakan | Buat | Ya |
| Absen Sekolah | Ya | — | Ya |
| Absen Mapel | Ya | — | Ya |
| Hasil Ujian / Nilai | Lihat | Download | Ya |
| Pengumuman | Lihat | — | Ya (CRUD) |
| Ganti Password | Ya | — | Ya |
| Data Siswa (CRUD) | — | Lihat | Ya |
| Data Guru (CRUD) | — | — | Ya |
| Master Kelas/Mapel/Jurusan | — | — | Ya |
| Import/Export Excel | — | — | Ya |
| Cetak (Kartu/Absen/Soal) | — | — | Ya |
| Backup & Restore | — | — | Ya |
| Pengaturan Sistem | — | — | Ya |
| Analisa Soal | — | Ya | Ya |
| Status Peserta Ujian | — | Ya | Ya |
| Denah Lokasi Duduk | — | — | Ya |
| Token Ujian | — | — | Ya |
| Data Cleanup | — | — | Ya (admin only) |

---

> **Catatan:** Dokumen ini dihasilkan dari analisis source code secara menyeluruh pada **28 September 2026**. Setiap perubahan pada file-file di atas dapat mempengaruhi akurasi dokumen ini.
