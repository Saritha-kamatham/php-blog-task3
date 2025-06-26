<?php
session_start();
require '../config/db.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("DELETE FROM posts WHERE id=$id AND user_id=$user_id");
header("Location: ../index.php");
