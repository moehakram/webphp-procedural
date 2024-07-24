<?php
namespace controllers;

use function repository\activate_user;
use function repository\find_unverified_user;
use function repository\register_user;
use function services\filterDataRegister;
use function services\generate_activation_code;
use function services\login as ServicesLogin;
use function services\logout as serviceLogout;
use function services\require_guest;
use function services\require_login;
use function services\send_activation_email;

function login(){
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
    
    if (ServicesLogin($inputs['username'], $inputs['password'], isset($inputs['remember_me']))) {
        redirect_to('/home');
    }
    
    $errors['login'] = 'Invalid username or password';
    redirect_with('/users/login', [
        'errors' => $errors,
        'inputs' => $inputs
    ]);    
}

function showLogin(){
    require_guest();
    $title = 'Login';
    $inputs = [];
    $errors = [];

    [$errors, $inputs] = session_flash('errors', 'inputs');

    view('login', compact('errors', 'inputs', 'title'));
}

function register(){

    require_guest();
    $errors = [];
    $inputs = [];

    [$inputs, $errors] = filterDataRegister($_POST);
    if ($errors) {
        redirect_with('/users/register', [
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
            '/users/login',
            'Silakan periksa email Anda untuk mengaktifkan akun Anda sebelum masuk.'
        );
    }
}

function showRegister(){
    require_guest();

    $title = 'Register';

    [$errors, $inputs] = session_flash('errors', 'inputs');

    view('register', compact('errors', 'inputs', 'title'));
}

function logout(){
    require_login();
    serviceLogout();
}

function activate(){
    // sanitize the email & activation code
    [$inputs, $errors] = filter($_GET, [
        'email' => 'string|required|email',
        'activation_code' => 'string|required'
    ]);

    if (!$errors) {

        $user = find_unverified_user($inputs['activation_code'], $inputs['email']);

        if ($user && activate_user($user['id'])) {
            redirect_with_message(
                '/users/login',
                'Akun Anda telah berhasil diaktifkan. Silakan login di sini.'
            );
        }
    }

    redirect_with_message(
        '/users/register',
        'Tautan aktivasi tidak valid, silakan daftarkan kembali.',
        FLASH_ERROR
    );
}