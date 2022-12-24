<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>導覽頁面</title>
</head>
<body>
    <?php
    include ('sql.php');
    session_start();
    $_SESSION['name']='請先登錄';
    $_SESSION['student_id']='';
    $_SESSION['sId']='';
    $_SESSION['aId']='';
    $name = $_SESSION['name'];
    echo "<center>";
    echo "你好，$name"."<br>";
    echo "歡迎來到屏科大模擬選課系統，本系統除了可以讓你選課之外，還可以讓你討論課程內容，讓你知道哪一個課程最適合你";
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
        echo "<td>上課星期</td>
        <td>上課節次</td>
        ";
        echo "<td>教室代號</td>";
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
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='login.php'>登錄</a>";
    }
    echo "</center>";
    ?>
</body>
</html>