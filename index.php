<?php
require './functions.php';
//declare use session
session_start();
connectDB();

//handle login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get input from user
    $username = $_POST['username'];
    $password = $_POST['password'];

    //check input username and password
    if (!$username || !$password) {
        echo "Invalid username or password!";
        exit;
    }

    $regex1 = preg_match('/[\'"^£$%&*()}{@#~?><>,|=_+¬-]/', $username);
    $regex2 = preg_match('/[\'"^£$%&*()}{@#~?><>,|=_+¬-]/', $password);
    if (!$regex1 && !$regex2) {
        
        $hashedPassword = hash('sha256', $password);
        $query = "SELECT * FROM users WHERE username = ? and password = ?";

        // Prevent SQLi by using prepared statement
        $preparedStatement = $conn->prepare($query);
        $preparedStatement->bind_param('ss', $username, $hashedPassword);
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();

        if ($result->num_rows > 0) {
            // Get information form DB
            $row = $result->fetch_assoc();
            // save session's data
            if ($hashedPassword == $row['password']) {
                $_SESSION["username"] = $row['username'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['phone_number'] = $row['phone_number'];
                //Check role of user and redirect to home page
                if ($row["role"] == "user") {
                    header("Location: User_Home.php");
                    exit;
                } elseif ($row["role"] == "admin") {
                    header("Location: Admin_Home.php");
                    exit;
                }
            } else {
                echo "Wrong password!";
                exit;
            }
        } else {
            echo "Username does not exist!";
            exit;
        }
    }
}
disconnectDB();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
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

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            color: white;
            text-align: left;
            overflow: hidden;

            &::before {
                content: "";
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 20%;
                height: 30%;
                background-color: rgba(0, 0, 0, 0.7);
                z-index: -1;
                border-radius: 10px;
            }
        }

        .content {
            position: relative;
            z-index: 1;
            padding: center;
            color: white;
        }
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="container">
        <div class="content">
            <form action="" method="post">
                <h3>Log in</h3>

                <div class="">
                    <input type="text" id="username" class="" name="username" style="border-radius: 5px" required />
                    <label for="username">Username</label>
                </div>

                <div class="">
                    <input type="password" id="password" class="" name="password" style="border-radius: 5px" required />
                    <label for="password">Password</label>
                </div>

                <div class="">
                    <button class="" type="submit" style="border-radius: 5px">Login</button>
                </div>

                <p class="">Don't have an account? <a href="User_Register.php" class="link-info"
                        style="color: white">Register here</a></p>
            </form>
        </div>
    </div>
</body>

</html>