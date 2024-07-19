<?php
require __DIR__ . '/../src/init.php';
require_login();
?>

<?php view('header', ['title' => 'Dashboard']) ?>
<p>Welcome <?= current_user() ?></p>
<a href="logout.php">Logout</a>
<?php view('footer'); ?>