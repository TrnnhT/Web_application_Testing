<?php
session_start();

$host = 'db4';
$user = 'user';
$pass = 'pass';
$db   = 'users_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Deliberate logic flaw: trim during comparison to check if it's 'admin'
    if (trim($row['username']) === 'admin') {
        $_SESSION['username'] = 'admin';
        $_SESSION['logged_in'] = true;
        header("Location: admin.php");
    } else {
        $_SESSION['username'] = $row['username'];
        $_SESSION['logged_in'] = true;
        header("Location: account.php");
    }
    exit();
}
}
?>

<?php
include 'layout.php';
startLayout("Login - FakeBook");
?>
<div class="form-container">
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="login.php">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Login</button>
    </form>
    <a href="register.php">Don't have an account? Register</a><br>
    <a href="forgot.php" style="color:#007BFF; text-decoration: underline;">Forgot password? Reset here</a>
</div>
<?php endLayout(); ?>
