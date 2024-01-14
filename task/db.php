<?php
$host_name = 'localhost';
$username_db = 'root';
$password_db = '';
$db_name = 'task';
//kết nối với cơ sở dữ liệu
$conn = new mysqli($host_name,$username_db,$password_db,$db_name);
// kiểm tra kết nối có thành công hay chưa
if ($conn->connect_error){
    die("kết nối thất bại: ".$conn->connect_error);
}
?>