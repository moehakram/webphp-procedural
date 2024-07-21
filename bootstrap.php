<?php

session_start();
// Memuat file konfigurasi
require_once __DIR__ . '/config/app.php';       // Konfigurasi aplikasi utama
require_once __DIR__ . '/config/database.php';  // Konfigurasi database

// Memuat file library
require_once __DIR__ . '/libs/helpers.php';        // Fungsi-fungsi bantu umum
require_once __DIR__ . '/libs/flash.php';          // Fitur flash message
require_once __DIR__ . '/libs/sanitization.php';   // Fungsi sanitasi input
require_once __DIR__ . '/libs/validation.php';     // Fungsi validasi input
require_once __DIR__ . '/libs/filter.php';         // Fungsi penyaringan data
require_once __DIR__ . '/libs/connection.php';     // Pengaturan koneksi database

// Memuat file repository
require_once __DIR__ . '/app/repository/users.php';
require_once __DIR__ . '/app/repository/user_tokens.php';

// Memuat file services
require_once __DIR__ . '/app/services/auth.php'; // Autentikasi pengguna
require_once __DIR__ . '/app/services/remember.php'; //Fitur "ingat saya" untuk sesi

define('ROUTES',  require __DIR__ . '/config/routes.php');

set_exception_handler(function(\Throwable $ex) {

    $time = date('Y-m-d H:i:s');
    $message = "[{$time}] Uncaught exception: " . $ex->getMessage() . "\n";
    $message .= "In file: " . $ex->getFile() . " on line " . $ex->getLine() . "\n";
    $message .= "Stack trace:\n" . $ex->getTraceAsString() . "\n";

    // Menulis log ke file
    error_log($message, 3, __DIR__ . '/logs/errors.log');

    // Mengeluarkan pesan ke pengguna
    echo 'Whoops, looks like something went wrong!';
});
