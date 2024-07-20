<?php
require __DIR__ . '/../bootstrap.php';
require_guest();

[$errors, $inputs] = controller('register');
$title = 'Register';
view('register', compact('errors', 'inputs', 'title'));
