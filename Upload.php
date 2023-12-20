<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload File</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            padding: 30px;
            color: #333;
        }

        h1 {
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
        body {
            background-color: #fafafa;
        }

        /* Update form styles */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"]{
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4285F4;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #4285F4;
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
    <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <!-- Post Title -->
        <h1>Post Title:</h1>
        <input type="text" name="post_title" placeholder="Enter file name">

        <!-- Content -->
        <h1>Content:</h1>
        <textarea name="post_content" rows="4" cols="100" placeholder="Write your content"></textarea>

        <!-- Submit button -->
        <button class="back-btn" type="submit" name="submit">Submit</button>
    </form>
</body>

</html>