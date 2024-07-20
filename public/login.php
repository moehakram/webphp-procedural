<?php
require __DIR__ . '/../bootstrap.php';
require_guest();

[$errors, $inputs] = controller('login');
$title = 'Login';
view('login', compact('errors', 'inputs', 'title'));