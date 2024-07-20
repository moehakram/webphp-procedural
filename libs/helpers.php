<?php

function dd($data){
    echo '<pre>';
    var_dump($data);
    echo "</pre>";
    die;
}

function write_log($message, $logfile = APP_LOG) {
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] " . (is_array($message) ? json_encode($message) : $message) . PHP_EOL;
    file_put_contents($logfile, $logMessage, FILE_APPEND);
}

/**
 * Display a view
 *
 * @param string $filename
 * @param array $data
 * @return void
 */

function view(string $filename, array $data = [])
{
    $pathView = fn($name) => __DIR__ . '/../app/views/' . trim($name, '/') . '.php';

    if (!file_exists($body = $pathView($filename))) {
        throw new Exception("File View " . basename($body) . " tidak ditemukan di [$body]");
    }
    
    extract($data);
    ob_start();
    include  $pathView('inc/header');
    include $body;
    include  $pathView('inc/footer');

    echo ob_get_clean();
    exit;
}

function dispatch_routes(string $method, string $path) : ?string
{
    $clean = fn($path) => ($path === '/') ? $path : str_replace(['%20', ' '], '-', rtrim($path, '/'));
    foreach (ROUTES[$method] ?? [] as $key => $controller) {
        $pattern = '#^' . $clean($key) . '$#';
        if (preg_match($pattern, $clean($path), $variabels)) {
            array_shift($variabels);
            return $controller;
        }
    }
    return null;
}

function controller(string $filename, array $keys = []) : array
{
    [$file, $callback] = explode(':',$filename, 2);

    $pathController = __DIR__ . '/../app/controllers/' . $file . '.php';
    
    if (!file_exists($pathController)) {
        throw new Exception("File Controller " . basename($pathController) . " tidak ditemukan di [$pathController]");
    }
    return [$pathController, '\\controllers\\'. $callback];
}


/**
 * Return the error class if error is found in the array $errors
 *
 * @param array $errors
 * @param string $field
 * @return string
 */
function error_class(array $errors, string $field): string
{
    return isset($errors[$field]) ? 'error' : '';
}

function request_method(): string
{
    return strtoupper($_SERVER['REQUEST_METHOD']);
}

function request_path(): string
{
    return $_SERVER['PATH_INFO'] ?? '/';
}

/**
 * Return true if the request method is POST
 *
 * @return boolean
 */
function is_post_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

/**
 * Return true if the request method is GET
 *
 * @return boolean
 */
function is_get_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}

/**
 * Redirect to another URL
 *
 * @param string $url
 * @return void
 */
function redirect_to(string $url): void
{
    header('Location:' . $url);
    exit;
}

/**
 * Redirect to a URL with data stored in the items array
 * @param string $url
 * @param array $items
 */
function redirect_with(string $url, array $items): void
{
    foreach ($items as $key => $value) {
        $_SESSION[$key] = $value;
    }

    redirect_to($url);
}

/**
 * Redirect to a URL with a flash message
 * @param string $url
 * @param string $message
 * @param string $type
 */
function redirect_with_message(string $url, string $message, string $type = FLASH_SUCCESS)
{
    flash('flash_' . uniqid(), $message, $type);
    redirect_to($url);
}

/**
 * Flash data specified by $keys from the $_SESSION
 * @param ...$keys
 * @return array
 */
function session_flash(...$keys): array
{
    $data = [];
    foreach ($keys as $key) {
        if (isset($_SESSION[$key])) {
            $data[] = $_SESSION[$key];
            unset($_SESSION[$key]);
        } else {
            $data[] = [];
        }
    }
    return $data;
}