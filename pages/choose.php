<?php
    include ('sql.php');
    $cId = $_GET['cId'];
    $CN = $_GET['course_name'];
    $CD = $_GET['course_date'];
    $ci = $_GET['class_id'];
    session_start();
    $sId = $_SESSION['sId'];
    $course_insert = "INSERT INTO subject_timetable (sId,cId,course_name,course_date,class_id) VALUES ('$sId','$cId','$CN','$CD','$ci')";
    mysqli_query($link,$course_insert);
    echo "<script>alert('已加入課表')</script>";
    header("refresh:0;url='timetable.php'");

?>