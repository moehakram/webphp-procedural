<?php

return [
    'POST' => [
        '/users/login'      => 'auth@login', // file_name:function_name
        '/users/register'   => 'auth@register',
    ],
    'GET' => [
        '/'                 => 'home@index',
        '/home'             => 'home@home',
        '/users/login'      => 'auth@showLogin',
        '/users/register'   => 'auth@showRegister',
        '/users/activate'   => 'remember@activate',
        '/users/logout'     => 'auth@logout',
        '/tes/(\d+)'        => 'home@testing',
        '/tes/(\w+)'        => 'home@testing',
    ]
];