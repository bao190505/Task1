<?php
$target_dir = "uploads/";
// những file được chấp nhận để upload
$allowed_extension = array( 'png','jpeg','gif', 'jpg');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_FILES['upload'])){

        $FileName = basename($_FILES['upload']['name']);
        
        //lấy phần mở rộng của file bà chuyển về chữ thường
        $FileType = strtolower(pathinfo($FileName,PATHINFO_EXTENSION));

        // kiểm tra file có hợp lệ không
        if(!in_array($FileType,$allowed_extension)){
            echo "file không hợp lệ";
        } 
        else {
            //kiểm tra kích thước của file
            if($_FILES['upload']['size'] >= 1000000){
                echo "file quá lớn";
            } 
            else {
                //đổi tên file
                $newFileName =$target_dir . hash('sha256',$FileName) . "." . $FileType;
                // di chuyển file đến thư mục
                if(move_uploaded_file($_FILES['upload']['tmp_name'],$newFileName)){
                    echo "upload file thành công " . $newFileName;
                }
                else{
                    echo "xảy ra lỗi trong quá trình tải lên";
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload</title>
</head>
<body>
    <div>
        <h2>Đăng nhập thành công</h2>
    </div>
    <form action="upload.php" method="POST" enctype="multipart/form-data" >
        select image to upload
        <input type="file" name="upload" >
        <input type="submit" value="upload">
    </form>
    <div>
        <a href="logout.php">Đăng xuất</a>
    </div>
    
</body>
</html>
