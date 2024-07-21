<?php

require __DIR__ . '/../bootstrap.php';

if(!$result = dispatch_routes(request_method(), request_path())){
    http_response_code(404);
    echo '<h1>Route Not Found <br> <a href="/">HOME</a></h1>';
    exit;
}

[$path_controller, $callback, $params] = $result;

require_once $path_controller;
$callback(...$params);