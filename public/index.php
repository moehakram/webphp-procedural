<?php
require __DIR__ . '/../bootstrap.php';
require_login();
view('inc/header', ['title' => 'Dashboard']);
?>

<p>Welcome <?= current_user() ?></p>
<a href="logout.php">Logout</a>

<?php view('inc/footer'); ?>