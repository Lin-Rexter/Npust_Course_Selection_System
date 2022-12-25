<?php
	// 請先將config.ini複製一份為config-自訂.ini，然後再備份在其他地方，需要使用時，再放到這個目錄中!
	// 讀取ini設定檔內容
	$path = __DIR__ . "/config-自訂.ini";
	$ini = parse_ini_file($path);

	// 讀取設定並設定變數
	define('_Port', $ini['port']);
	define('_Username', $ini['username']);
	define('_Password', $ini['password']);

    $host = 'localhost'; // 本地端名稱
    $port = _Port; // 連接埠(不須設定，自動讀取config.ini設定檔)
    $dbname = 'npust_course_selection_system'; // 資料庫名稱
    $username = _Username; // 帳號名稱(不須設定，自動讀取config.ini設定檔)
    $password = _Password; // 帳號密碼(不須設定，自動讀取config.ini設定檔)


    // https://www.php.net/manual/zh/refs.database.php
    // php操作數據庫可使用PDO(可用於不同資料庫)或是mysqli(專為MySQL)，mysql則是最原始(已棄用)
    // mysqli支持OOP(object，面向對象)或是POP(procedural，面向過程，就是使用函式寫法)
    // 在這個項目使用的是OOP方式開發，使用OOP(物件導向式)的好處有繼承、可重用等特性，較優


	// 顯示所有錯誤
    // mysqli_report(MYSQLI_REPORT_ALL);
    try{
        $link = new mysqli($host, $username, $password, $dbname, $port); // 宣告連線
    }catch(Exception $e){
        echo $e->getMessage();
        die("資料庫連線失敗!");
    }

    $link->query("SET NAMES UTF8"); // 設定UTF8編碼
    date_default_timezone_set('Asia/Taipei'); // 設定時區
?>