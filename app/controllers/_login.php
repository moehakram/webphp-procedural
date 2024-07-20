<?php

require_guest();

[$inputs, $errors] = filter($_POST, [
    'username' => 'string | required',
    'password' => 'string | required',
    'remember_me' => 'string'
],[
    'required' => '%s wajib diisi'
]);

if ($errors) {
    redirect_with('/users/login', ['errors' => $errors, 'inputs' => $inputs]);
}

if (login($inputs['username'], $inputs['password'], isset($inputs['remember_me']))) {
    redirect_to('/home');
}

$errors['login'] = 'Invalid username or password';
redirect_with('/users/login', [
    'errors' => $errors,
    'inputs' => $inputs
]);
