<?php
require './functions.php';
session_start();
connectDB();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$query = 'SELECT id, post_title FROM posts';
$result = $conn->query($query);

// Hiển thị danh sách bài đăng
if ($result->num_rows > 0) {
    echo '<ul>';
    while ($row = $result->fetch_assoc()) {
        $postId = $row['id'];
        $postTitle = $row['post_title'];

        echo '<li><a href="view_post.php?id=' . $postId . '">' . $postTitle . '</a></li>';
    }
    echo '</ul>';
} else {
    echo 'No posts available.';
}

disconnectDB();
?>
