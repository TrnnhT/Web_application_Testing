<?php
session_start();

// Only allow real 'admin' (not 'admin ') to access this page
if (!isset($_SESSION['logged_in']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'layout.php';
startLayout("Admin Panel - FakeBook");
?>

<h2>Admin Tools</h2>
<p>Welcome, Admin. Use the tool below to check if a user is exists or not in this system.</p>

<form method="GET" action="admin.php">
    <label>Search Users:</label>
    <input type="text" name="search" placeholder="Enter username..." required>
    <button type="submit">Search</button>
</form>

<br>

<pre>
<?php
if (isset($_GET["search"])) {
    $search = $_GET["search"];

    // Intentionally vulnerable to command injection
    $command = "cut -d':' -f1 /etc/passwd | grep $search";

    $returned_user = exec($command);

    if ($returned_user == "") {
        // No output → user not found (real or injected)
        $result = "<div class='alert alert-danger' role='alert'>
        <strong>Error!</strong> User <b>$search</b> was not found on the <b>system</b>.
        </div>";
    } else {
        // Any output → consider as 'found'
        $result = "<div class='alert alert-success' role='alert'>
        <strong>Success!</strong> User <b>$search</b> was found on the <b>system</b>.
        </div>";
    }

    echo $result;
}
?>
</pre>

<?php endLayout(); ?>
