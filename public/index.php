<?php

require __DIR__ . '/../bootstrap.php';

$result = dispatch_routes(request_method(), request_path());
if(!$result){
    http_response_code(404);
    echo '<h1>Route Not Found <br> <a href="/">HOME</a></h1>';
    exit;
}

[$controller, $callback] = controller($result);

require_once $controller;
$callback();