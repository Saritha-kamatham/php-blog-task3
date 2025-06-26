<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $user_id);
    $stmt->execute();
    header("Location: ../index.php");
}
?>

<link rel="stylesheet" href="../style.css">
<div class="container">
    <form method="POST">
        <h2>Create Post</h2>
        Title: <input type="text" name="title" required>
        Content:<br><textarea name="content" required></textarea>
        <button type="submit">Create</button>
    </form>
    <a href="../dashboard.php">← Back to Dashboard</a>
</div>
