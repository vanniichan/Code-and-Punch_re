<?php
    require './functions.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Add student to the database
        $username = $_POST["username"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
    
        $result = Add_Users($username, $password, $name, $email, $phone_number);
        if ($result) {
            // Student added successfully
            echo "Users added successfully!";
            header("Location: index.php");
        } else {
            // Failed to add student (username already exists)
            echo "Username already exists. Please choose a different username.";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Sign Up</title>
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
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
            margin-top: 10px;
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
            text-align: center;
        }

        .success-message {
            color: #00CC00;
            margin-top: 10px;
            text-align: center;
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
    <h1>Sign Up</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required>
        
        <input type="submit" value="Sign Up">

        <button class="back-btn" onclick="location.href='index.php'" type="button">Trở về</button>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Display success or error message
            if ($result) {
                echo '<p class="success-message">User registed successfully!</p>';
            } else {
                echo '<p class="error-message">Username already exists. Please choose a different username.</p>';
            }

        }
        ?>
    </form>
</body>
</html>