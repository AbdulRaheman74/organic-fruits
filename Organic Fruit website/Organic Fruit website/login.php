<?php
session_start();

// Connect to database
$connection = mysqli_connect("localhost", "username", "password", "user_authentication");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$login = $_POST['username'];
$password = $_POST['password'];

// Verify user credentials
$sql = "SELECT * FROM users WHERE username='$login' OR email='$login'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if (password_verify($password, $row['password'])) {
    echo "Login successful!";
    $_SESSION['username'] = $row['username'];
} else {
    echo "Login failed. Invalid username/email or password.";
}

mysqli_close($connection);
?>
