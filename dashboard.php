<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}
?>

<link rel="stylesheet" href="style.css">
<div class="container">
    <h2>Welcome, <?= $_SESSION['username'] ?>!</h2>
    <a href="posts/create.php">➕ Create New Post</a><br>
    <a href="index.php">📃 View All Posts</a><br>
    <a href="auth/logout.php">🚪 Logout</a>
</div>
