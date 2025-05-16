<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['logged_in']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'layout.php';
startLayout("Admin Panel - FakeBook");
?>

<h2>Admin Tools</h2>
<p>Welcome, Admin. Use the tool below to check if the Username is exist in this FakeBook application.</p>

<form method="GET" action="admin.php">
    <label>Search Users: </label>
    <input type="text" name="q" placeholder="Enter username..." required>
    <button type="submit">Search</button>
</form>

<pre>
<?php
if (isset($_GET['q'])) {
    $search = $_GET['q'];

    $cmd = "echo '$search' | grep '' > /dev/null 2>&1";
    system($cmd);
    echo "[!] Checked for user matching: $search\n";
    echo "Result: Username exists or not has been processed (output suppressed).";
}
?>
</pre>

<?php endLayout(); ?>
