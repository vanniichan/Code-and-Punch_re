<?php
    require './functions.php';
    connectDB();
    session_start();
    global $conn;
    
    function validateData($data) {
        $newData = stripslashes(trim(htmlspecialchars($data, ENT_QUOTES, "UTF-8")));
        return $newData;
    }

    if (!isset($_SESSION['username'])) {
        header("Location: index.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Lấy dữ liệu từ form
        $post_title = validateData($_POST['post_title']);
        $post_content = validateData($_POST['post_content']);
    
        // Thực hiện truy vấn để lưu dữ liệu vào MySQL
        $query = 'INSERT INTO posts (post_title, post_content) VALUES (?, ?)';
        if ($statement = $conn->prepare($query)) {
            $statement->bind_param('ss', $post_title, $post_content);
            $statement->execute();
            $statement->close();
            echo "Post uploaded successfully.";
        } else {
            echo "Failed to execute the query.";
        }
    }
    
    // Đóng kết nối
    disconnectDB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
<?php
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        echo '<button class="back-btn" onclick="location.href=\'Admin_Home.php\'" type="button">Trở về</button>';
    } else {
        echo '<button class="back-btn" onclick="location.href=\'User_Home.php\'" type="button">Trở về</button>';
    }
?>
</body>
</html>
