<?php
require __DIR__ . '/../bootstrap.php';
require_guest();

[$errors, $inputs] = controller('login');
view('inc/header', ['title' => 'Login']);
view('login', compact('errors', 'inputs'));
view('inc/footer');