<?php

require_guest();

$title = 'Register';
$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'username' => 'string | required | alphanumeric | between: 3, 25 | unique: users, username',
        'email' => 'email | required | email | unique: users, email',
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password',
        'agree' => 'string | required'
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

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('register.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    $activation_code = generate_activation_code();

    if (register_user($inputs['email'], $inputs['username'], $inputs['password'], $activation_code)) {
        write_log([
            "username" => $inputs['username'],
            "password" => $inputs['password']
        ]);
        send_activation_email($inputs['email'], $activation_code);

        redirect_with_message(
            'login.php',
            'Silakan periksa email Anda untuk mengaktifkan akun Anda sebelum masuk.'
        );
    }
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}

view('register', compact('errors', 'inputs', 'title'));
