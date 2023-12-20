<?php 

session_start();

// Kiểm tra xem có session 'role' không
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Nếu không có hoặc không phải là admin, chuyển hướng về trang trước đó hoặc trang mặc định
    header('Location: index.php');
    exit();
}

    require './functions.php';
    $users=Get_Users_Infor();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
          body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        a {
            display: inline-block;
            background-color: #4285F4;
            color: #fff;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #1967D2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .options-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .options-btn input {
            margin-right: 10px;
            background-color: #4285F4;
            color: #fff;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .options-btn input:hover {
            background-color: #1967D2;
        }

        .delete-form {
            display: inline-block;
        }

        .delete-form input[type="submit"] {
            background-color: #FF0000;
            color: #fff;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-form input[type="submit"]:hover {
            background-color: #DC143C;
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
    <title>Danh sách người dùng</title>
</head>
<body>
    <h1>Danh sách người dùng</h1>
    <a href="Add_Users.php">Thêm người dùng</a><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Options</th>
        </tr>
        <?php foreach ($users as $item) { ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['phone_number']; ?></td>
                <td class="options-btn">
                    <input onclick="window.location = 'Users_Edit.php?id=<?php echo $item['id']; ?>'" type="button" value="Sửa">
                    <form class="delete-form" method="post" action="Users_Delete.php" onsubmit="return confirm('Bạn có chắc muốn xóa không?');">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <input type="submit" name="delete" value="Xóa">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <button class="back-btn" onclick="location.href='Admin_Home.php'" type="button">Trở về</button>
</body>
</html>