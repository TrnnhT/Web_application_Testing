<?php
session_start();
require_once 'layout.php';

$host = 'db3';
$user = 'user';
$pass = 'pass';
$db   = 'users_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$username = $_GET['username'] ?? ($_SESSION['new_user'] ?? null);
$error = null;
$data = null;
$executed = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['show_answers']) && $username) {
    // Insecure: no access control check on which user is logged in
    $stmt = $conn->prepare("SELECT grad_year, birth_year, favorite_color FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    if ($stmt->execute()) {
        $stmt->bind_result($grad, $birth, $color);
        if ($stmt->fetch()) {
            $data = [
                'Graduated Year' => $grad,
                'Birth Year' => $birth,
                'Favorite Color' => $color
            ];
        } else {
            $error = "No data found for user.";
        }
    } else {
        $error = "Query failed.";
    }
    $stmt->close();
    $executed = true;
}

startLayout("Welcome " . htmlspecialchars($username ?? 'Guest'));
?>

<h2>Registration Successful!</h2>

<?php if ($username): ?>
    <p>Welcome to FakeBook, <strong><?= htmlspecialchars($username) ?></strong>!</p>
<?php else: ?>
    <p style="color: red;">No user session or parameter detected.</p>
<?php endif; ?>

<form method="POST">
    <button type="submit" name="show_answers">Show My Answers</button>
</form>

<?php if ($error): ?>
    <div style="color: red; margin-top: 10px;"><?= htmlspecialchars($error) ?></div>
<?php elseif ($data): ?>
    <div style="margin-top: 20px;">
        <h4>Security Answers for <em><?= htmlspecialchars($username) ?></em>:</h4>
        <ul>
            <?php foreach ($data as $key => $val): ?>
                <li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($val) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php elseif ($executed): ?>
    <div style="margin-top: 20px;">
        <em>User exists but no answers found.</em>
    </div>
<?php endif; ?>

<p style="margin-top:20px;"><a href="login.php">Proceed to Login</a></p>

<?php endLayout(); ?>
