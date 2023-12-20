<?php
require './functions.php';
connectDB();

// Lấy thông tin người dùng hiện tại
$loggedInUser = getLoggedInUserData();

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate thông tin
    $errors = array();
    if (empty($email)) {
        $errors['email'] = 'Chưa nhập email người dùng';
    }

    // Nếu không có lỗi thì chỉnh sửa thông tin người dùng
    if (empty($errors)) {
        // Gọi hàm chỉnh sửa thông tin người dùng
        Edit_User($loggedInUser['id'], $name, $email, $phone_number, $password);

        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            header("Location: Admin_Home.php");
        } else {
            header("Location: User_Home.php");
        }

        exit();
    }
}
disconnectDB();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Users</title>
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
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            background-color: #4285F4;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #1967D2;
        }

        .error-message {
            color: #FF0000;
            margin-top: 10px;
        }

        .success-message {
            color: #00CC00;
            margin-top: 10px;
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
    </style>
</head>
<body>
    <h1>Edit User</h1>
    <?php 
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            echo '<button class="back-btn" onclick="location.href=\'Admin_Home.php\'" type="button">Trở về</button>';
        } else {
            echo '<button class="back-btn" onclick="location.href=\'User_Home.php\'" type="button">Trở về</button>';
        }
    ?>
    <form method="post" action="Edit_Logged_In_User.php?id=<?php echo $loggedInUser['id']; ?>">
        <table border="0" cellspacing="0" cellpadding="10">
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="name" value="<?php echo $loggedInUser['name']; ?>"/>
                    <?php if (!empty($errors['name'])) echo $errors['name']; ?>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="email" value="<?php echo $loggedInUser['email']; ?>"/>
                    <?php if (!empty($errors['email'])) echo $errors['email']; ?>
                </td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td>
                    <input type="text" name="phone_number" value="<?php echo $loggedInUser['phone_number']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" value=""/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="Edit_Student" value="Lưu"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>