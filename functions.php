<?php
global $conn;
function connectDB()
{
    global $conn;
    $conn = mysqli_connect("localhost", "root", "", "DB");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    return $conn;
}
function disconnectDB()
{
    global $conn;
    if ($conn) {
        mysqli_close($conn);
    }
}
function Edit_User($id, $name, $email, $phone_number, $password)
{
    global $conn;

    connectDB();

    $id = intval($id);
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone_number = mysqli_real_escape_string($conn, $phone_number);
    $password = mysqli_real_escape_string($conn, $password);
    $hashedPassword = hash('sha256', $password);

    $Edit_User = "UPDATE users SET name = '$name', email = '$email', phone_number = '$phone_number', password = '$hashedPassword' WHERE id = $id";

    $query = mysqli_query($conn, $Edit_User);

    disconnectDB();

    return $query;
}
function Delete_Users($id)
{
    global $conn;
    connectDB();
    $id = intval($id);

    $Delete_Users = "DELETE FROM users WHERE id = $id";

    $query = mysqli_query($conn, $Delete_Users);

    disconnectDB();
    return $query;
}
function Add_Users($username, $password, $name, $email, $phone_number)
{
    global $conn;
    connectDB();

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone_number = mysqli_real_escape_string($conn, $phone_number);
    $hashedPassword = hash('sha256', $password);

    $username_query = "SELECT id FROM users WHERE username = '$username'";
    $query_check = mysqli_query($conn, $username_query);
    if ($query_check && mysqli_num_rows($query_check) == 0) {
        $Add_Users = "INSERT INTO users (username, password, role, name, email, phone_number) VALUES ('$username', '$hashedPassword', 'user', '$name', '$email', '$phone_number')";
        mysqli_query($conn, $Add_Users);
        $query = true;
    } else {
        $query = false;
    }
    disconnectDB();
    return $query;
}

function Get_Users_Infor()
{
    global $conn;

    connectDB();

    $Get_Infor = "SELECT * FROM users WHERE role = 'user'";

    $query = mysqli_query($conn, $Get_Infor);

    $result = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }
    return $result;
}
function Get_1_User_Infor($id)
{
    global $conn;
    connectDB();

    $id = intval($id);

    $get_infor = "SELECT * FROM users WHERE id = $id";

    $query = mysqli_query($conn, $get_infor);

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    return $result;
}

function logout()
{
    if (isset($_SESSION)) {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }
    header("Location: index.php");
    exit;
}
function getLoggedInUserData()
{
    session_start();

    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (!isset($_SESSION['username'])) {
        return null; // Nếu chưa đăng nhập, trả về null hoặc một giá trị thích hợp
    }

    $userData = array(
        'id' => $_SESSION['id'],
        'name' => $_SESSION['name'],
        'email' => $_SESSION['email'],
        'phone_number' => $_SESSION['phone_number'],
    );

    return $userData;
}

function searchPostByTitle($title)
{
    global $conn;

    // Sử dụng prepared statement để tránh SQL injection
    $query = 'SELECT id FROM posts WHERE post_title = ?';
    if ($statement = $conn->prepare($query)) {
        $statement->bind_param('s', $title);
        $statement->execute();
        $statement->bind_result($postId);

        if ($statement->fetch()) {
            $statement->close();
            return $postId; // Trả về ID của bài đăng nếu tìm thấy
        }

        $statement->close();
    }

    return null; // Trả về null nếu không tìm thấy
}
?>