<?php

require_login();
view('home', [
    'title' => 'Dashboard',
    'username' => current_user()
]);