<?php
session_start();
require 'config/db.php';

$result = $conn->query("
    SELECT posts.*, users.username FROM posts 
    JOIN users ON posts.user_id = users.id 
    ORDER BY posts.created_at DESC
");
?>

<link rel="stylesheet" href="style.css">
<div class="container">
    <h2>All Posts</h2>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="post-card">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
            <small>By <?= $row['username'] ?> on <?= $row['created_at'] ?></small>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id']): ?>
                <div class="actions">
                    <a href="posts/edit.php?id=<?= $row['id'] ?>">✏️ Edit</a>
                    <a href="posts/delete.php?id=<?= $row['id'] ?>">🗑️ Delete</a>
                </div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>
