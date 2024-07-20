<?php

require_login();
view('index', [
    'title' => 'Dashboard',
    'username' => current_user()
]);