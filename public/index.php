<?php
require __DIR__ . '/../bootstrap.php';
require_login();
view('index', ['title' => 'Dashboard']);