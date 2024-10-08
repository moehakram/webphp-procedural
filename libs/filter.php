<?php // source : https://www.phptutorial.net/

function filter(array $data, array $fields, array $messages = []): array
{
    $sanitization = [];
    $validation = [];

    foreach ($fields as $field => $rules) {
        if (strpos($rules, '|')) {
            [$sanitization[$field], $validation[$field]] = explode('|', trim($rules), 2);
        } else {
            $sanitization[$field] = $rules;
        }
    }

    $inputs = sanitize($data, $sanitization);
    $errors = validate($inputs, $validation, $messages);

    return [$inputs, $errors];
}