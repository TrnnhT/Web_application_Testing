<?php
/* $host = 'db1';
$user = 'user';
$pass = 'pass';
$db   = 'users_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$step = 1;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['grad_year'], $_POST['birth_year'], $_POST['favorite_color'])) {
        $username = $_POST['username'];
        $grad = trim($_POST['grad_year']);
        $birth = trim($_POST['birth_year']);
        $color = strtolower(trim($_POST['favorite_color']));

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($user = $res->fetch_assoc()) {
            $db_grad = $user['grad_year'];
            $db_birth = $user['birth_year'];
            $db_color = strtolower(trim($user['favorite_color']));

            if ($grad === $db_grad && $birth === $db_birth && $color === $db_color) {
                $step = 2;
            } else {
                $message = "Incorrect answers. Try again.";
            }
        } else {
            $message = "User not found.";
        }
    } elseif (isset($_POST['username'], $_POST['new_password'])) {
        $username = $_POST['username'];
        $newpass = md5($_POST['new_password']);

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $newpass, $username);
        if ($stmt->execute()) {
            $message = "Password reset successful! <a href='login.php'>Login</a>";
            $step = 3;
        } else {
            $message = "Error updating password.";
        }
    }
}
?>

<?php
include 'layout.php';
startLayout("Forgot Password - FakeBook");
?>

<div class="form-container">
    <h2>Reset Your Password</h2>
    <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>

    <?php if ($step === 1): ?>
        <form method="POST">
            <label>Username: <input type="text" name="username" required></label><br><br>

            <label>What year did you graduate? (0 if not yet)</label><br>
            <input type="text" name="grad_year" required><br><br>

            <label>What year were you born?</label><br>
            <input type="text" name="birth_year" required><br><br>

            <label>What is your favorite color?</label><br>
            <input type="text" name="favorite_color" required><br><br>

            <button type="submit">Submit</button>
        </form>

    <?php elseif ($step === 2): ?>
        <form method="POST">
            <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
            <label>New Password: <input type="password" name="new_password" required></label><br><br>
            <button type="submit">Reset Password</button>
        </form>

    <?php else: ?>
        <p><?= $message ?></p>
    <?php endif; ?>
</div>

<?php endLayout(); 
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coming Soon</title>
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }
        .message-box {
            border: 2px dashed #aaa;
            padding: 40px;
            text-align: center;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h1>This Function is in Development</h1>
        <p>Please come back later.</p>
    </div>
</body>
</html>
