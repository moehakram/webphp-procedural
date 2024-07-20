<?php
namespace services;

use function repository\delete_user_token;
use function repository\find_user_token_by_selector;
use function repository\insert_user_token;

function generate_tokens(): array
{
    $selector = bin2hex(random_bytes(16));
    $validator = bin2hex(random_bytes(32));

    return [$selector, $validator, $selector . ':' . $validator];
}

function parse_token(string $token): ?array
{
    $parts = explode(':', $token);

    if ($parts && count($parts) == 2) {
        return [$parts[0], $parts[1]];
    }
    return null;
}

function remember_me(int $user_id, int $day = 30)
{
    [$selector, $validator, $token] = generate_tokens();

    // remove all existing token associated with the user id
    delete_user_token($user_id);

    // set expiration date
    $expired_seconds = time() + 60 * 60 * 24 * $day;

    // insert a token to the database
    $hash_validator = password_hash($validator, PASSWORD_DEFAULT);
    $expiry = date('Y-m-d H:i:s', $expired_seconds);

    if (insert_user_token($user_id, $selector, $hash_validator, $expiry)) {
        setcookie('remember_me', $token, $expired_seconds);
        write_log('remember_me id : ' . $user_id);
    }

}

function token_is_valid(string $token): bool {
    [$selector, $validator] = parse_token($token);

    $tokens = find_user_token_by_selector($selector);
    if (!$tokens) {
        return false;
    }
    
    return password_verify($validator, $tokens['hashed_validator']);
}