<?php
session_start();

$host = 'db2';
$user = 'user';
$pass = 'pass';
$db   = 'users_db';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $hashed = md5($password); // Apply MD5 hashing

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashed'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: account.php");
        exit();
    } else {
        $error = "Invalid credentials";
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
