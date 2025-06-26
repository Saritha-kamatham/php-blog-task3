<?php
session_start();
require '../config/db.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$post = $conn->query("SELECT * FROM posts WHERE id=$id AND user_id=$user_id")->fetch_assoc();
if (!$post) die("Post not found or access denied.");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=? AND user_id=?");
    $stmt->bind_param("ssii", $title, $content, $id, $user_id);
    $stmt->execute();
    header("Location: ../index.php");
}
?>

<link rel="stylesheet" href="../style.css">
<div class="container">
    <form method="POST">
        <h2>Edit Post</h2>
        Title: <input type="text" name="title" value="<?= $post['title'] ?>" required>
        Content:<br><textarea name="content" required><?= $post['content'] ?></textarea>
        <button type="submit">Update</button>
    </form>
</div>
