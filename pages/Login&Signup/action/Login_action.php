<?php
require('../../../module/connect.php'); // 載入連線模組
require('../../../module/mysql.php'); // 載入資料庫操作模組
require('../../../module/other.php'); // 其他功能模組

$link = new Mysql($link); // 進行連線

$username = $_POST['username']; // 取得填入的登入帳號名
$password = $_POST['password']; // 取得填入的登入密碼
$student_id = $_POST['student_id'] ?? false; // 取得填入的學號，如未填入則返回false

// 判斷是否有填入學號(雖尚未開放填入學號，先寫好條件)
if (isset($_POST['student_id'])) {
    $sql_WHERE = "WHERE BINARY username='$username' AND student_id=$student_id"; // BINARY 區分大小寫
} else {
    $sql_WHERE = "WHERE BINARY username='$username'";
}

// 查詢帳號名稱，返回帳號密碼
$account_pwd = $link->select(['username, password, student_id', 'account', "$sql_WHERE"]);

// 使用dict結構存取錯誤結果
$mes_arr = array(
    'err_name' => !$account_pwd[0] ? true : false, // 判斷帳號是否不存在，否則返回false
    // 比對登入密碼與經雜湊加密過的密碼是否不一致，否則返回false
    'err_pass' => $account_pwd[0] ? (!password_verify($password, $account_pwd[1]->fetch_all(MYSQLI_ASSOC)[0]['password']) ?? false) : false,
);

// 判斷是否有錯誤，否則進行登入動作
if (in_array(true, array_values($mes_arr))) {
    // 將錯誤資料加密
    $en_mes = en_url($mes_arr);

    header("refresh:0; url='../Login.php?en_mes=$en_mes'"); // 註冊資料已存在，跳轉回原本的註冊介面
} else {
    // 啟用session
    session_start();

    $_SESSION = array(); // 每次登入時，重置在首頁的提示紀錄

    $_SESSION['is_login'] = true; // 儲存是否為登入狀態
    $_SESSION['npust_username'] = $username;
    $_SESSION['npust_SID'] = $student_id;

    $en_mes = en_url(
        array(
            'login' => true
        )
    );
    header("refresh:0; url='../../../home.php?en_mes_login=$en_mes'");
}

?>
