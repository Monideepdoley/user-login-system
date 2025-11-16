<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Select user based on email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        
        // Check password
        if (password_verify($password, $row['password'])) {
            
            // Create session
            $_SESSION["user"] = $row["name"];
            
            echo "Login successful! Welcome, " . $_SESSION["user"];
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found with that email!";
    }

    mysqli_stmt_close($stmt);
}
?>
