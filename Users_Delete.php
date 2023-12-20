<?php

require './functions.php';

// Thực hiện xóa
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
if ($id){
    Delete_Users($id);
}

// Trở về trang danh sách
header("location: Users_List.php");