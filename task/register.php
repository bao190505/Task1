<?php
include "db.php";

session_start();
$message = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){

  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    
    if($password !== $confirm){
        $message = "nhập lại mật khẩu";
    }
    else{
         $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        //kiểm tra username đã tồn tại hay chưa
        if($stmt->get_result()->num_rows > 0){
            $message = 'username đã tồn tại';
        }else {
            try{
                //thêm username và password vào cơ sở dữ liệu
                $query = "INSERT INTO users(username,password) VALUE (?,?)";
                //chuẩn bị câu lệnh sql
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss",$username,$password);
                $stmt->execute();
                $message = "tạo tài khoản thành công";
                }   catch(Exception $e){
                     die("Error");
                }
            }  
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
            <h2>Đăng kí</h2>
        </div>
        <div class="container">
            <form action="register.php" id="login" method="POST">
                <input type="text" name="username" id="username" placeholder="username">
                <br></br>
                <input type="password" name="password" id="password" placeholder="password">
                <br></br>
                <input type="password" name="confirm" id="confirm" placeholder="confirm">
                <br></br>
                <input type="submit" id="submit" value="Đăng Kí">
                <br></br>
                <a href="login.php">Đăng nhập</a>
                <div class="ss">
                <?php echo $message; ?>
                </div>
            </form>
        </div>
    </body>
</html>  