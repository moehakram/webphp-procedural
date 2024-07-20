<?php

require __DIR__ . '/../bootstrap.php';



$inputs = [
    'email' => 'testihhng@email.com',
    'username' => 'akram1h23',
    'password' => 'pasworD#admi123',
    'password2' => 'pasworD#admi123',
    'agree' => 'checked',
    'activation_code' => generate_activation_code(),
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