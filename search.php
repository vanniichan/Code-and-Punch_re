<?php
require './functions.php';
session_start();
connectDB();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Kiểm tra xem form đã được submit chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = isset($_POST['search_term']) ? $_POST['search_term'] : '';

    // Gọi hàm để tìm kiếm bài đăng theo tiêu đề
    $postId = searchPostByTitle($searchTerm);

    if ($postId !== null) {
        // Nếu tìm thấy, chuyển hướng đến trang view_post.php của bài đăng đó
        header("Location: view_post.php?id=" . $postId);
        exit();
    } else {
        echo 'No matching posts found.';
    }
}

disconnectDB();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Thêm khoảng cách từ form đến danh sách bài đăng */
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }


        .back-btn {
            display: block;
            margin-top: 20px;
            background-color: #333;
            color: #fff;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Search Post</h1>
    <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            echo '<button class="back-btn" onclick="location.href=\'Admin_Home.php\'" type="button">Trở về</button>';
        } else {
            echo '<button class="back-btn" onclick="location.href=\'User_Home.php\'" type="button">Trở về</button>';
        }
    ?>
    
    <!-- Form để tìm kiếm -->
    <form method="post" action="">
        <label for="search_term">Search by Name:</label>
        <input type="text" name="search_term" id="search_term" required>
        <button class="back-btn" type="submit">Search</button>
    </form>