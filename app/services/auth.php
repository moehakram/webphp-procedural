<?php

function is_user_active($user)
{
    return (int)$user['active'] === 1;
}

function login(string $username, string $password, bool $remember = false): bool
{

    $user = find_user_by_username($username);

    // if user found, check the password
    if ($user && is_user_active($user) && password_verify($password, $user['password'])) {

        log_user_in($user);

        if ($remember) {
            remember_me($user['id']);
        }

        return true;
    }

    return false;
}

function log_user_in(array $user): bool
{
    // prevent session fixation attack
    if (session_regenerate_id()) {
        // set username & id in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        write_log("Login user: {$user['id']}, {$user['username']}");
        return true;
    }

    return false;
}

function is_user_logged_in(): bool
{
    // check the session
    if (isset($_SESSION['username'])) {
        return true;
    }

    // check the remember_me in cookie
    $token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($token && token_is_valid($token)) {

        $user = find_user_by_token($token);

        if ($user) {
            return log_user_in($user);
        }
    }
    return false;
}

function require_login(): void
{
    if (!is_user_logged_in()) {
        redirect_to('/login');
    }
}

function require_guest(): void
{
    if (is_user_logged_in()) {
        redirect_to('/');
    }
}

function logout(): void
{
    if (is_user_logged_in()) {

        // delete the user token
        delete_user_token($id = $_SESSION['user_id']);
        write_log("logout user_id: $id");
        // delete session
        unset($_SESSION['username'], $_SESSION['user_id`']);

        // remove the remember_me cookie
        if (isset($_COOKIE['remember_me'])) {
            unset($_COOKIE['remember_me']);
            setcookie('remember_user', null, -1);
        }

        // remove all session data
        session_destroy();

        // redirect to the login page
        redirect_to('/login');
    }
}

function current_user()
{
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}

function generate_activation_code(): string
{
    return bin2hex(random_bytes(16));
}

function send_activation_email(string $email, string $activation_code): void
{
    // create the activation link
    $activation_link = APP_URL . "/activate?email=$email&activation_code=$activation_code";
    
    write_log("activation_link : " . $activation_link);

    // $subject = 'Please activate your account';
    // $message = <<<MESSAGE
    //         Hi,
    //         Please click the following link to activate your account:
    //         $activation_link
    //         MESSAGE;
    // // email header
    // $header = "From:" . SENDER_EMAIL_ADDRESS;

    // send the email
    // mail($email, $subject, nl2br($message), $header);

}
