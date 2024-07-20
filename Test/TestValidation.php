<?php

require __DIR__ . '/../bootstrap.php';

$inputs = [
    'email' => 'testing9@email.com',
    'username' => 'akram1237',
    'password' => 'pasworD#admin123',
    'password2' => 'pasworD#admin123',
    'agree' => 'checked',
    'activation_code' => generate_activation_code(),
];

$fields = [
    'username' => 'required|alphanumeric|between: 3, 25 | unique: users, username',
    'email' => 'email| required | email | unique: users, email',
    'password' => 'required | secure',
    'password2' => 'required | same: password',
    'agree' => 'required'
];

$messages = [
    'required' => '%s wajib diisi',
    'email' => '%s bukan alamat email yang valid',
    'min' => '%s harus memiliki setidaknya %s karakter',
    'max' => '%s harus memiliki paling banyak %s karakter',
    'between' => '%s harus memiliki antara %d dan %d karakter',
    'same' => '%s harus cocok dengan %s',
    'alphanumeric' => '%s hanya boleh terdiri dari huruf dan angka',
    'secure' => '%s harus memiliki antara 8 hingga 64 karakter dan mengandung setidaknya satu angka, satu huruf kapital, satu huruf kecil, dan satu karakter khusus',
    'unique' => '%s sudah ada',
    'password' => [
        'secure' => 'Password harus memiliki antara 8 hingga 64 karakter dan mengandung setidaknya satu angka, satu huruf kapital, satu huruf kecil, dan satu karakter khusus.'
    ],
    'password2' => [
        'required' => 'Harap konfirmasi password di isi',
        'same' => 'Password tidak sama!'
    ],
    'agree' => [
        'required' => 'Anda perlu menyetujui syarat layanan untuk mendaftar.'
    ]
];

$errors = validate($inputs, $fields, $messages);
var_dump($errors);
