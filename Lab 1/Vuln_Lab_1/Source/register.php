<?php
$host = 'db1';
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
    $grad_year = $_POST['grad_year'] ?? '';
    $birth_year = $_POST['birth_year'] ?? '';
    $favorite_color = $_POST['favorite_color'] ?? '';

    $hashed = md5($password); // keep it md5 for lab purposes

    $sql = "INSERT INTO users (username, password, grad_year, birth_year, favorite_color) 
            VALUES ('$username', '$hashed', '$grad_year', '$birth_year', '$favorite_color')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<?php
include 'layout.php';
startLayout("Register - FakeBook");
?>
<div class="form-container">
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="register.php">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br><br>

        <label>What year are you graduated? (use "0" if not yet):<br>
            <input type="number" name="grad_year" required></label><br>

        <label>What year were you born?<br>
            <input type="number" name="birth_year" required></label><br>

        <label>What is your favorite color?<br>
            <input type="text" name="favorite_color" required></label><br>

        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</div>
<?php endLayout(); ?>
