<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>討論區</title>
</head>
<body>
    <?php
    include ('sql.php');
    #$cId = $_GET['cId'];
    session_start();
    $account = $_SESSION['aId'];
    $sId = $_SESSION['sId'];
    echo "<center>";
    $c_select = "SELECT * FROM course WHERE cId = $cId";
    $c_query = mysqli_query($link,$c_select);
    $c_array = mysqli_fetch_array($c_query);
    $g_select = "SELECT * FROM guestbook WHERE cId = $cId";
    $g_query = mysqli_query($link,$g_select);
    $g_num = mysqli_num_rows($g_query);
    if ($g_num!=0){
        echo $c_array['course_name']."討論區";
        echo "<table border='1'>
        <tr>
        <td>發言人</td>
        <td>發言時間</td>
        <td>內容</td>
        </tr>";
        while($g_array = mysqli_fetch_array($g_query)){
            echo "<tr>
            <td>{$g_array['message_name']}</td>
            <td>{$g_array['message_time']}</td>
            <td>{$g_array['content']}</td>
            </tr>
            ";
        }
        echo "</table>";

    }
    else{
        echo "這堂課還沒有留言喔~";
    }
    echo "<a href='add_message.php?cId=$cId'>新增留言</a>&nbsp";
    echo "<a href='main.php'>首頁</a>";
    echo "</table>";
    echo "</center>";
    ?>
</body>
</html>