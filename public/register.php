<?php
require __DIR__ . '/../bootstrap.php';
require_guest();

[$errors, $inputs] = controller('register');
view('inc/header', ['title' => 'Register']);
view('register', compact('errors', 'inputs'));
view('inc/footer');
