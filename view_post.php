<?php
require './functions.php';
session_start();
connectDB();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    $query = 'SELECT post_title, post_content FROM posts WHERE id = ?';
    if ($statement = $conn->prepare($query)) {
        $statement->bind_param('i', $postId);
        $statement->execute();
        $statement->bind_result($postTitle, $postContent);

        if ($statement->fetch()) {
            echo '<h2>' . $postTitle . '</h2>';
            echo '<p>' . $postContent . '</p>';
        } else {
            echo 'Post not found.';
        }

        $statement->close();
    }
} else {
    echo 'Invalid request.';
}

disconnectDB();
?>
