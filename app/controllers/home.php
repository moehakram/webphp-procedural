<?php
namespace controllers;

use function services\current_user;
use function services\require_guest;
use function services\require_login;

function home(){
    require_login();
    view('home', [
    'title' => 'Dashboard',
    'username' => current_user()
    ]);
}

function index(){
    require_guest();
    view('index');
}

function testing(array $params){
    echo $params[0]; 
}