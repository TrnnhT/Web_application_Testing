<?php
session_start();
require_once 'layout.php';

$username = $_SESSION['username'] ?? null;

if (!$username) {
    header("Location: login.php");
    exit();
}

$host = 'db4';
$user = 'user';
$pass = 'pass';
$db   = 'users_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$xxeOutput = null;
$xxeError = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = $_POST['caption'] ?? '';
    $file = $_FILES['image'] ?? null;

    // XXE parsing
    if (!empty($caption)) {
        libxml_use_internal_errors(true);

        $xml = new DOMDocument();
        try {
            $xml->loadXML($caption, LIBXML_NOENT | LIBXML_DTDLOAD);
            $xxeOutput = $xml->textContent;
        } catch (Throwable $e) {
            $xxeError = "Error parsing XML: " . htmlspecialchars($e->getMessage());
        }
    }
}

$statuses = $conn->query("SELECT * FROM status ORDER BY created_at DESC");

startLayout("FakeBook - Home");
?>

<h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Status (caption in XML):</label><br>
    <textarea name="caption" rows="6" cols="60" placeholder="Say something in XML..." required></textarea><br><br>

    <label>Upload Image (optional):</label>
    <input type="file" name="image"><br><br>

    <button type="submit">Post</button>
</form>

<?php if ($xxeOutput): ?>
    <div style="margin-top: 20px; border: 1px dashed #888; padding: 10px;">
        <h4>Parsed XML Output (XXE Triggered):</h4>
        <pre><?= htmlspecialchars($xxeOutput) ?></pre>
    </div>
<?php elseif ($xxeError): ?>
    <p style="color: red;"><?= $xxeError ?></p>
<?php endif; ?>

<hr>
<h3>Recent Posts</h3>
<div style="width: 500px;">
    <?php while ($row = $statuses->fetch_assoc()): ?>
        <div class="post-box">
            <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
            <?php if ($row['image_path']): ?>
                <img src="<?= htmlspecialchars($row['image_path']) ?>" style="max-width:100%; margin-top:10px;">
            <?php endif; ?>
            <div style="font-size:12px; color:gray; margin-top:10px;">
                Posted on <?= $row['created_at'] ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php endLayout(); ?>
