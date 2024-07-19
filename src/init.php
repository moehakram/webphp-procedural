<?php

session_start();
// Memuat file konfigurasi
require_once __DIR__ . '/../config/app.php';       // Konfigurasi aplikasi utama
require_once __DIR__ . '/../config/database.php';  // Konfigurasi database

// Memuat file library
require_once __DIR__ . '/libs/helpers.php';        // Fungsi-fungsi bantu umum
require_once __DIR__ . '/libs/flash.php';          // Fitur flash message
require_once __DIR__ . '/libs/sanitization.php';   // Fungsi sanitasi input
require_once __DIR__ . '/libs/validation.php';     // Fungsi validasi input
require_once __DIR__ . '/libs/filter.php';         // Fungsi penyaringan data
require_once __DIR__ . '/libs/connection.php';     // Pengaturan koneksi database

// Memuat file sumber tambahan
require_once __DIR__ . '/auth.php';                // Autentikasi pengguna
require_once __DIR__ . '/remember.php';            // Fitur "ingat saya" untuk sesi
