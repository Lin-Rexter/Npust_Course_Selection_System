<?php
    $host = 'localhost';
    $port = '3306';
    $dbname = 'npust_course_selection_system';
    $username = 'Wen';
    $password = 'a20030625';

    // https://www.php.net/manual/zh/refs.database.php
    // php操作數據庫可使用PDO(可用於不同資料庫)或是mysqli(專為MySQL)，mysql則是最原始(已棄用)
    // mysqli支持OOP(object，面向對象)或是POP(procedural，面向過程，就是使用函式寫法)
    // 在這個項目使用的是OOP方式開發，使用OOP(物件導向式)的好處有繼承、可重用等特性，較優


	// 顯示所有錯誤
    //mysqli_report(MYSQLI_REPORT_ALL);
    try{
        $link = new mysqli($host, $username, $password, $dbname, $port);
    }catch(Exception $e){
        echo $e->getMessage();
        die("資料庫連線失敗!");
    }

    $link->query("SET NAMES UTF8");
    date_default_timezone_set('Asia/Taipei');
?>