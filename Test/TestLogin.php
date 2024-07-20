<?php

use function services\login;

require __DIR__ . '/../bootstrap.php';

$inputs = [
    'username' => 'hkak7',
    'password' => 'HdlL%GJDA#JAK765',
    'remember_me' => 'yes'
];
$is_login = login($inputs['username'], $inputs['password'], isset($inputs['remember_me']));
// account aktif
var_dump($is_login); // true

$inputs2 = [
    'username' => 'akram1235',
    'password' => 'pasworD#admin123',
    'remember_me' => 'yes'
];
$is_login2 = login($inputs2['username'], $inputs2['password'], isset($inputs2['remember_me']));
// account non-aktif
var_dump($is_login2); // false