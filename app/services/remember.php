<?php

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

function token_is_valid(string $token): bool {
    [$selector, $validator] = parse_token($token);

    $tokens = find_user_token_by_selector($selector);
    if (!$tokens) {
        return false;
    }
    
    return password_verify($validator, $tokens['hashed_validator']);
}