<?php

require_guest();

$title = 'Register';

[$errors, $inputs] = session_flash('errors', 'inputs');

view('register', compact('errors', 'inputs', 'title'));
