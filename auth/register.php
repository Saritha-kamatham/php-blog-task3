<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['username'] = $username;
    header("Location: ../dashboard.php");
}
?>

<link rel="stylesheet" href="../style.css">
<div class="container">
    <form method="POST">
        <h2>Register</h2>
        Username: <input type="text" name="username" required>
        Password: <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</div>
