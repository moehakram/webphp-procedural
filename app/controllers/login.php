<?php

require_guest();

$title = 'Login';
$inputs = [];
$errors = [];

[$errors, $inputs] = session_flash('errors', 'inputs');

view('login', compact('errors', 'inputs', 'title'));