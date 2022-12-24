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
    $cId = $_GET['cId'];
    echo"<center><form method='POST' action='add_message_action.php'>
    姓名:<input type ='text' name='name' ><br>
    內容:<input type = 'text' name='content'><br>
    <input type = 'submit' value='送出'>
    <input type='hidden' name = 'cId' value='$cId'>
    </from></center>";
    ?>
</body>
</html>