<?php
    require('../../module/other.php'); // 其他功能模組

    session_start();

    try{
        $_SESSION = array(); // 將所有SESSION值設定初始化

        // session_unset();
        session_destroy(); // 重置SESSION(包含session id)

        // session_id(); 可附加到url進行傳遞至其他網頁
        // 註: session_id作用在於當使用session_start時，session_id將會重置，當自行設置session_id時，則不會重置，可應用在訪客計數器等等...
        // 註: 若session_id不存在，就算SESSION值存在則無法傳遞至其他網頁

        $en_mes = en_url(
                        array(
                            'logout' => true
                        )
                    );
        header("refresh:0; url='../../home.php?en_mes_logout=$en_mes'");
    }catch(Exception $e){
        $en_mes = en_url(
            array(
                'logout' => false
            )
        );
        header("refresh:0; url='../../home.php?en_mes_logout=$en_mes'");
    }
?>