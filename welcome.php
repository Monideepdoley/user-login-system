<?php
session_start();

if (!isset($_SESSION["user"])) {
    echo "You must log in first!";
    exit();
}
?>

<h2>Welcome, <?php echo $_SESSION["user"]; ?>!</h2>
<a href="logout.php">Logout</a>
