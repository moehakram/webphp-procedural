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

const ROUTES = [
    'POST' => [
        '/users/login'      => 'auth@login', // file_name:function_name
        '/users/register'   => 'auth@register',
    ],
    'GET' => [
        '/'                 => 'home@index',
        '/home'             => 'home@home',
        '/users/login'      => 'auth@showLogin',
        '/users/register'   => 'auth@showRegister',
        '/users/activate'   => 'remember_me@activate',
        '/users/logout'     => 'auth@logout',
        '/tes/(\d+)'        => 'home@testing',
        '/tes/(\w+)'        => 'home@testing',
    ]
];