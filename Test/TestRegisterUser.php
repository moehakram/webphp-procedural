<?php

require __DIR__ . '/../bootstrap.php';

$inputs = [
    'username' => 'akram1235',
    'email' => 'testing4@email.com',
    'password' => 'pasworD#admin123',
    'password2' => 'pasworD#admin123',
    'agree' => 'checked'
];

$activation_code = generate_activation_code();
$result = register_user($inputs['email'], $inputs['username'], $inputs['password'], $activation_code);
var_dump($result);
$user = find_user_by_username($inputs['username']);
var_dump($user);