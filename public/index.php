<?php

require __DIR__ . '/../bootstrap.php';

switch (request_path()) {
    case '/':
        controller('home');
        break;
    case '/login':
        controller('login');
        break;
    case '/register':
        controller('register');
        break;
    case '/activate':
        controller('activate');
        break;
    case '/logout':
        require_login();
        logout();
        break;
    default:
        redirect_to('/');
        // http_response_code(404);
        // echo 'Route Not Found';
}