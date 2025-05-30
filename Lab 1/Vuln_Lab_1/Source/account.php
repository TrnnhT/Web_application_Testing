<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
    header("Location: admin.php");
    exit();
}

require_once 'layout.php';

$host = 'db1';
$user = 'user';
$pass = 'pass';
$db   = 'users_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// No extension filtering — fully vulnerable
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $content = $_POST['status'] ?? '';
    $imagePath = null;

    if (!empty($content) || !empty($_FILES['image']['name'])) {
        $uploadDir = 'uploads/';
        $filename = $_FILES['image']['name']; 
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            echo "Uploaded: $targetPath";
            $imagePath = $targetPath;
        } else {
            echo "Upload failed.";
        }

        $stmt = $conn->prepare("INSERT INTO status (content, image_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $content, $imagePath);
        $stmt->execute();
    }
}

$statuses = $conn->query("SELECT * FROM status ORDER BY created_at DESC");

startLayout("Account");
?>

<div class="form-container">
    <form method="POST" enctype="multipart/form-data">
        <textarea name="status" placeholder="What do you think?" rows="4" style="width:100%;margin-top:10px;"></textarea><br>
        <input type="file" name="image">
        <button type="submit">Post Status</button>
    </form>
</div>

<div style="margin-top: 40px; width: 500px;">
    <h3>Recent Posts</h3>
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
