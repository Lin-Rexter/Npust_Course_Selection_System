<body>
<?php
    include ('sql.php');
    $name = $_POST['name'];
    $password = $_POST['password'];
    $ps = $_POST['ps'];
    $grade = $_POST['grade'];
    $birthday =$_POST['birthday'];
    $student_id = $_POST['id'];
    if($password=$ps){
        $find_account="SELECT * FROM account WHERE student_id='$student_id'";
        $result = mysqli_query($link,$find_account);
        $row = mysqli_num_rows($result);
        if($row == 0){  
            $a_insert = "INSERT INTO account (username,password,student_id) VALUES ('$name','$password','$student_id')";
            $a_result =mysqli_query($link,$a_insert);
            if ($a_result){
                $a_select = "SELECT * FROM account WHERE password='$password'";
                $a_s_result = mysqli_query($link,$a_select);
                $a_s_row = mysqli_fetch_array($a_s_result);
                $aid = $a_s_row['aId'];
                $s_insert = "INSERT INTO student (name,student_id,grade,birthday,aId) VALUES ('$name','$student_id','$grade','$birthday','$aid') ";
                $s_i_result = mysqli_query($link,$s_insert);
                if ($s_i_result){
                    echo "<script>alert('註冊成功')</script>";
                    header("refresh:0;url='login.php'");
                }
                else{
                    echo "<script>alert('註冊失敗，請再試一次')</script>";
                    header ("refresh:0;url='register.php'");
                }
            }
        else{
            echo "<script language='Javascript'>";
            echo "alert('This account has been used');";
            echo "location.href='register.php'";
            echo "</script>";
        }
    }
    else{
        echo "<script language='Javascript'>";
        echo "alert('兩次密碼不一樣')";
        echo "location.href='register.php'";
        echo "</script>";
    }
    }
?>
</body>
</html>