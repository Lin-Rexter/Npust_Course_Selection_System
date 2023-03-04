<?php
require('../../../module/connect.php'); // 載入連線模組
require('../../../module/mysql.php'); // 載入資料庫操作模組
require('../../../module/other.php'); // 其他功能模組

$username = $_POST['username']; // 帳號
$password = $_POST['password']; // 密碼
$email = $_POST['email']; // 電子郵件
$student_id = $_POST['student_id'] ?? false; // 學號

$link = new Mysql($link); // 進行連線

// 先檢查是否已有相同帳號
$find_account = $link->select(['username', 'account', "WHERE BINARY username='$username'"]); // BINARY 區分大小寫
// 然後檢查電子郵件
$find_email = $link->select(['email', 'account', "WHERE BINARY email='$email'"]);
// 最後檢查學號
$find_SID = $link->select(['student_id', 'account', "WHERE BINARY student_id='$student_id'"]) ?? false;

// 使用dict結構存取錯誤結果
$mes_arr = array(
    'err_name' => $find_account[0] ? (isset($find_account[1]->fetch_all(MYSQLI_ASSOC)[0]) ?? false) : false, // 判斷是否存在相同帳號，否則返回false
    'err_mail' => $find_email[0] ? (isset($find_email[1]->fetch_all(MYSQLI_ASSOC)[0]) ?? false) : false, // 判斷是否存在相同email，否則返回false
    'err_SID' => $find_SID[0] ? (isset($find_SID[1]->fetch_all(MYSQLI_ASSOC)[0])) ?? false : false // 判斷是否存在相同學號，否則返回false
);

//print_r($mes_arr);

// 判斷是否有錯誤，否則進行新增帳號動作
if (in_array(true, array_values($mes_arr))) {
    // 將錯誤資料加密
    $en_mes = en_url($mes_arr);

    header("refresh:0; url='../Signup.php?en_mes=$en_mes'"); // 註冊資料已存在，跳轉回原本的註冊介面
} else {
    $psw_hash = password_hash($password, PASSWORD_DEFAULT); // 將密碼雜湊加密，生成長度為60個字元，不建議使用MD5加密

    // 檢查是否填入學號
    if (empty($student_id)) {
        $sql = [
            'account(username, password, email, student_id, create_time)',
            ["$username", "$psw_hash", "$email", NULL, date('Y-m-d H:i:s')] // 如未填入學號，則設置為NULL值
        ];
    } else {
        $sql = [
            'account(username, password, email, student_id, create_time)',
            ["$username", "$psw_hash", "$email", "$student_id", date('Y-m-d H:i:s')]
        ];
    }

    // 新增帳號至資料庫
    try {
        $a_insert = $link->insert([$sql]);

        $en_mes = en_url(
            array(
                'account_success' => true // 傳送帳號註冊成功訊息
            )
        );

        header("refresh:0; url='../Login.php?en_mes=$en_mes'"); // 帳號新增成功，跳轉至登入介面
    } catch (Exception $e) {
        $en_mes = en_url(
            array(
                'err_account' => $e->getMessage() // 傳送帳號註冊失敗的系統訊息
            )
        );
        header("refresh:0; url='../Signup.php?en_mes=$en_mes'"); // 帳號新增失敗，跳轉回原本的註冊介面
    }
}
