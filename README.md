# Kemudi LMS (Learning Management System & Computer Based Test)

Kemudi LMS (sebelumnya dikenal sebagai Candy Redis V2.1.2) adalah aplikasi Ujian Berbasis Komputer (CBT) dan sistem manajemen pembelajaran terintegrasi yang dirancang untuk kebutuhan sekolah (PTS/PAS/USBN/Simulasi Ujian). Aplikasi ini dioptimalkan dengan Redis caching untuk menjamin performa tinggi saat menampung ribuan siswa secara bersamaan.

---

## 🛠️ Tech Stack

*   **Bahasa Pemrograman Backend**: PHP (Native PHP untuk Portal Utama & Siswa, CodeIgniter 3 untuk Portal Guru).
*   **Database Relasional**: MySQL / MariaDB.
*   **Caching & Optimization**: Redis Database (digunakan via library `predis` / `RedisClient` untuk cache jawaban ujian, sesi aktif, dan manajemen beban query database).
*   **Bahasa Frontend**: HTML5, CSS3, JavaScript (ES6+).
*   **Framework & Pustaka UI**:
    *   Bootstrap 3 (Desain web responsif).
    *   AdminLTE 2 (Template Dashboard Admin & Guru).
    *   jQuery (Penanganan AJAX request respons cepat).
    *   SweetAlert2 (Popup dialog modern).
    *   DataTables (Tabel interaktif dengan pencarian cepat).
    *   Summernote & TinyMCE (Editor teks kaya untuk penyusunan soal ujian).
    *   FontAwesome 5 & Ionicons (Ikonografi aplikasi).
*   **Manajemen Paket**: Composer.

---

## ✨ Fitur Utama Berdasarkan Peran

### 1. Panel Siswa (Murid)
*   **Dashboard Jadwal Ujian**: Menampilkan daftar ujian aktif hari ini.
*   **Antarmuka Ujian CBT Responsif**:
    *   Navigasi soal cepat dengan nomor soal berkode warna.
    *   Tombol ragu-ragu dan fitur penanda jawaban.
    *   Auto-Save jawaban otomatis berbasis AJAX & Redis untuk perlindungan kehilangan data koneksi.
    *   Penghitung waktu mundur ujian otomatis.
*   **Modul Tugas & Materi**:
    *   Membaca dan mengunduh materi pelajaran (PDF, Word, Gambar, video Google Drive/YouTube).
    *   Mengerjakan tugas daring (tugas online) dan mengunggah jawaban.
*   **Presensi & Kehadiran Daring**:
    *   Melakukan absen harian lengkap dengan fitur unggah foto selfie presensi.
*   **Informasi Hasil Ujian & Kelulusan**: Melihat riwayat nilai tugas/ujian secara real-time.

### 2. Panel Guru (CI-based Portal)
*   **Manajemen Bank Soal**:
    *   Membuat soal Pilihan Ganda (PG), Esai, maupun campuran (PG & Esai).
    *   Upload gambar/audio per soal.
    *   Pengaturan acak soal dan acak opsi jawaban.
*   **Pusat Materi & Tugas Daring**:
    *   Publikasi materi pembelajaran per mata pelajaran.
    *   Pembuatan tugas dan pemeriksaan tugas online siswa beserta penilainnya.
*   **Manajemen Ujian**:
    *   Merilis jadwal ujian untuk mata pelajaran yang diampu.
    *   Memantau (monitoring) status pengerjaan ujian siswa kelasnya.
*   **Analisis & Rekap Nilai**:
    *   Melihat rekap nilai akhir ujian siswa dan menganalisis butir soal secara mendalam.
*   **Kehadiran Guru**: Melakukan presensi kedatangan guru secara online.

### 3. Panel Admin (Crew Portal)
*   **Data Master**: Mengelola data sekolah, kelas, mata pelajaran, sesi, ruang, jurusan, tahun ajaran, dan status sinkronisasi Dapodik.
*   **Data Pengguna**: Mengelola data guru, pengawas ujian, dan data siswa secara massal (Import/Export Excel, Mass Upload Foto Siswa).
*   **Manajemen Pelaksanaan Ujian**:
    *   Menyusun jadwal ujian sekolah secara global.
    *   Mengatur jenis ujian (PTS, PAS, USBN, Try Out, dll).
    *   Mengatur rilis Token Ujian untuk validasi keamanan siswa.
    *   Membuat berita acara ujian dan daftar hadir pengawas.
*   **Monitoring & Kontrol Real-Time**:
    *   Melihat siswa aktif yang sedang ujian beserta progress pengerjaan.
    *   Fitur reset status ujian/login jika siswa mengalami kendala perangkat.
    *   Fitur blokir akses siswa tertentu.
*   **Rekapitulasi Nilai & Cetak Dokumen**:
    *   Rekapitulasi nilai per kelas/mata pelajaran dan ekspor ke Excel.
    *   Cetak Kartu Ujian Siswa dan denah ruang ujian.
*   **Pengaturan Sistem**:
    *   Manajemen backup & restore database.
    *   Pengaktifan mode maintenance (Mainten Mode) bagi portal siswa.
    *   Konfigurasi detail sekolah, logo, kop surat kartu, dan zona waktu.

---

## ⚡ Caching Redis & Keunggulan
Aplikasi ini dikonfigurasi untuk terhubung dengan server Redis lokal guna meminimalkan query berulang ke database SQL. Jawaban sementara siswa saat ujian disimpan langsung di memory Redis terlebih dahulu sebelum dipindahkan ke tabel database (melalui proses `nilai_pindah`). Hal ini mencegah bottleneck server saat ujian berlangsung serentak.

---
*Member Of Nusa Garuda Studio*
