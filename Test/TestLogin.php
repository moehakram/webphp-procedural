<?php

require __DIR__ . '/../bootstrap.php';

$inputs = [
    'username' => 'hkak7',
    'password' => 'HdlL%GJDA#JAK765',
    'remember_me' => 'yes'
];
$is_login = login($inputs['username'], $inputs['password'], isset($inputs['remember_me']));
// account aktif
var_dump($is_login); // true

$inputs = [
    'username' => 'akram1235',
    'password' => 'pasworD#admin123',
    'remember_me' => 'yes'
];
$is_login = login($inputs['username'], $inputs['password'], isset($inputs['remember_me']));
// account non-aktif
var_dump($is_login); // false