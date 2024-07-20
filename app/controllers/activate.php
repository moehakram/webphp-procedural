<?php

if (is_get_request()) {
    // sanitize the email & activation code
    [$inputs, $errors] = filter($_GET, [
        'email' => 'string|required|email',
        'activation_code' => 'string|required'
    ]);
    
    if (!$errors) {

        $user = find_unverified_user($inputs['activation_code'], $inputs['email']);

        if ($user && activate_user($user['id'])) {
            redirect_with_message(
                '/login',
                'Akun Anda telah berhasil diaktifkan. Silakan login di sini.'
            );
        }
    }
}

redirect_with_message(
    '/register',
    'Tautan aktivasi tidak valid, silakan daftarkan kembali.',
    FLASH_ERROR
);
