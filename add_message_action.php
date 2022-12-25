<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增留言</title>
</head>
<body>
    <?php
    include ('sql.php');
    $cId = $_POST['cId'];
    $message_name = $_POST['name'];
    date_default_timezone_set('Asia/Taipei');
    $message_time = date("Y-m-d H:i:s");
    $content = $_POST['content'];
    session_start();
    $aId = $_SESSION['aId'];
    $g_insert = "INSERT INTO guestbook (aId,cId,message_name,message_time,content) VALUES('$aId','$cId','$message_name','$message_time','$content')";
    $g_query = mysqli_query($link,$g_insert);
    if ($g_query){
        echo "<script>alert('新增成功')</script>";
        header ("refresh:0;url='main.php'");
    }
    ?>
</body>
</html>