<?php

include "db.php";
session_start();
$message = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        try{
            $query = "SELECT * FROM users WHERE username = ? and password=?";
            // chuẩn bị câu lệnh sql
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss",$username,$password);
            $stmt->execute();
            
        } catch(Exception $e){
            die("Error");
        }
        $result = $stmt->get_result();
        //kiểm tra username và password
        if($result->num_rows > 0){
            // di chuyển page sang page upload
            header("Location: upload.php");
        } 
        else{
            $message = "sai username/password";
        }
    }
}
?>

<!DOCTYPE htmt>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div >
            <h2>Đăng Nhập</h2>
        </div>
        <div class="container">
            <form action="login.php" id="login" method="POST">
                <input type="text" name="username" id="username" placeholder="username">
                <br></br>
                <input type="password" name="password" id="password" placeholder="password">
                <br></br>
                <input type="submit" id="submit" value="Đăng Nhập">
                <br></br>
                <?php  echo $message; ?>
                <a href="register.php">Đăng kí</a>
            </form>
        </div>
    </body>
</html>  