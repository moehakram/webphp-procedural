<?php

require __DIR__ . '/../bootstrap.php';

$inputs = [
    'username' => 'akram1h23',
    'email' => 'testihhng@email.com',
    'password' => 'pasworD#admi123',
    'password2' => 'pasworD#admi123',
    'agree' => 'checked'
];

$fields = [
    'username' => 'string',
    'email' => 'email',
    'password' => 'string',
    'password2' => 'string',
    'agree' => 'string'
];

$inputs = sanitize($inputs, $fields);
var_dump($inputs);