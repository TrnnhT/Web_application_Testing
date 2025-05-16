<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'layout.php';

$previewResult = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_url'])) {
    $url = $_POST['image_url'];

    $previewResult = @file_get_contents($url);
    //http://127.0.0.1/edit_admin.php

}

startLayout("Admin Panel");
?>

<h2>Welcome, Admin</h2>

<h3>🧪 Image Preview Tool</h3>
<form method="POST">
    <label for="image_url">Enter an image URL to preview:</label><br>
    <input type="text" name="image_url" id="image_url" style="width: 400px;">
    <button type="submit">Preview</button>
</form>

<?php if ($previewResult): ?>
    <div style="margin-top: 20px;">
        <h4>Preview Result:</h4>
        <pre style="background: #f0f0f0; padding: 10px; border-radius: 4px;">
<?= htmlspecialchars($previewResult) ?>
        </pre>
    </div>
<?php endif; ?>

<?php endLayout(); ?>
