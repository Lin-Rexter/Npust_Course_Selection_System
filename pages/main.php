<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
</head>
<body>
    <?php
    include ('sql.php');
    session_start();
    $name = $_SESSION['name'];
    $sId = $_SESSION['sId'];
    $aId = $_SESSION['aId'];
    echo "<center>";
    echo $name."同學您好<br>";
    echo "<a href ='timetable.php?sId=$sId'>課表</a>";
    $class_select = "SELECT * FROM course";
    $c_s_result = mysqli_query($link,$class_select);
    $c_s_row = mysqli_num_rows($c_s_result);
    if($c_s_row != 0){
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>課程代碼</td>";
        echo "<td>開課系所</td>";
        echo "<td>授課教師</td>";
        echo "<td>課程名稱</td>";
        echo "<td>開課狀態</td>";
        echo "<td>班級</td>";
        echo "<td>學分</td>";
        echo "<td>修別(必、選)</td>";
        echo "<td>上課時數</td>";
        echo "<td>上課星期</td>";
        echo "<td>節次</td>";
        echo "<td>教室代號</td>";
        echo "<td colspan='2'>";
        echo "</tr>";
        while ($c_s_rows = mysqli_fetch_array($c_s_result)){
            echo "<tr>";
            echo "<td>".$c_s_rows['course_id']."</td>";
            echo "<td>".$c_s_rows['department']."</td>";
            echo "<td>".$c_s_rows['teacher']."</td>";
            echo "<td>".$c_s_rows['course_name']."</td>";
            echo "<td>".$c_s_rows['course_status']."</td>";
            echo "<td>".$c_s_rows['class_name']."</td>";
            echo "<td>".$c_s_rows['credit']."</td>";
            echo "<td>".$c_s_rows['subject']."</td>";
            echo "<td>".$c_s_rows['course_hours']."</td>";
            echo "<td>".$c_s_rows['day_of_week']."</td>";
            echo "<td>".$c_s_rows['period']."</td>";
            echo "<td>".$c_s_rows['class_id']."</td>";
            echo "<td><a href='choose.php?cId=".$c_s_rows['cId']."&course_name=".$c_s_rows['course_name']."&day=".$c_s_rows['day_of_week']."&period=".$c_s_rows['period']."&class_id=".$c_s_rows['class_id']."'>選課</a>";
            echo "<td><a href='guestbook.php?cId=".$c_s_rows['cId']."&course_name=".$c_s_rows['course_name']."'>討論區</a>" ;
            echo "</tr>";
        }
        echo "</table>";
    }
    echo "<form method='POST' action='logout.php'> <input type='submit' name='logout' value='登出'>";
    echo "</center>";
    ?>
</body>
</html>