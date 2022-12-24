<?php
    session_start();
    $logout = @$_POST['logout'];
    if ($logout != "") {
        session_destroy();
        header("refresh:0;url='index.php'");
    }
?>