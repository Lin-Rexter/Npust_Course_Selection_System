<?php
    include ('sql.php');
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];
    $account = "SELECT * FROM account WHERE student_id = '$student_id' AND password = '$password'";
    $a_result = mysqli_query($link,$account);
    $a_result_row = mysqli_num_rows($a_result);
    $a_id = mysqli_query($link,$account);
    $a_id_array = mysqli_fetch_array($a_id); 
    $_SESSION['aId']=$a_id_array['aid'];
    if ($a_result_row == 1){
        $s_select = "SELECT * FROM student WHERE student_id = '$student_id'";
        $aid_select ="SELECT* FROM account WHERE student_id = '$student_id'";
        $a_id = mysqli_query($link,$aid_select);
        $a_id_array = mysqli_fetch_array($a_id); 
        $s_result = mysqli_query($link,$s_select);
        $s_rows = mysqli_fetch_array($s_result);
        $name = $s_rows['name'];
        $sId = $s_rows['sId'];
        session_start();
        $_SESSION['name'] = $name;
        $_SESSION['sId'] = $sId;
        $_SESSION['student_id'] = $s_rows['student_id'];
        $_SESSION['aId']=$a_id_array['aId'];
        header("refresh:0;url='main.php'");
    }
?>  