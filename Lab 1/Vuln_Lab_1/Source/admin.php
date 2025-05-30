<?php
session_start();
require_once 'layout.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

startLayout("Lab 1 Complete - FakeBook");
?>
<div class="form-container">
    <h2>Congratulations!</h2>
    <p>You have successfully completed Lab 1.</p>
    <p>Here is your flag: {lab1_flag_captured}</p>
</div>
<?php endLayout(); ?>
