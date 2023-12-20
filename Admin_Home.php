<?php
    session_start();
    require './functions.php';
    connectDB();

    $get_admin_data = "SELECT * FROM users WHERE username=?";
    $preparedStatement = $conn->prepare($get_admin_data);
    $preparedStatement -> bind_param("s", $username );
    $preparedStatement->execute();
    $result = $preparedStatement->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px;
            color: white;
        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-image: url(./bối\ rối\ nét.jfif);
            background-size: 100% 100%;
            background-position: center center;
            background-repeat: no-repeat;
            z-index: -1;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        h2 {
            margin-top: 40px;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 30px;
        }

        form a {
            display: inline-block;
            background-color: #4285F4;
            color: #fff;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }

        form a:hover {
            background-color: #4285F4;
        }

        /* Update background color */
        /* body {
            background-color: #fafafa;
        } */

        /* Update form styles */
        .form-group {
            margin-bottom: 20px;
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
    <div class="background"></div>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>

    <!-- Add Users -->
    <h2>Add User</h2>
    <form method="post" action="">
        <a href="Add_Users.php">Add User</a>
    </form>

    <!-- Display Users List -->
    <h2>Display Users List</h2>
    <form method="post" action="">
        <a href="Users_List.php">Users List</a>
    </form>
    
    <!-- Upload File -->
    <h2>Post something</h2>
        <form method="post" action="">
        <a href="Upload.php">Post</a>
    </form>

    <!-- View Uploaded File -->
    <h2>View All Posts</h2>
    <form method="post" action="">
        <a href="view_all_posts.php">Click here to view</a>
    </form>

    <h2>Search</h2>
    <form method="post" action="">
        <a href="search.php">Click here to search post!</a>
    </form>

    <!-- Update Profile -->
    <h2>Update Profile</h2>
    <form method="post" action="">
        
        <a href="Edit_Logged_In_User.php">Click here</a>
    </form>

    <button class="back-btn" onclick="location.href='logout.php'" type="button">Log out</button>
</body>

</html>
