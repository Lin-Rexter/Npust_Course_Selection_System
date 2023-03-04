<?php
    // session操作
    class session{
        function __construct($mes){
            $this->$mes = $mes;
        }

        
    }

    // 將表單要傳送的值編碼
    function en_url($values){
        $enUrlObj = serialize($values); // 進行解碼
        $serializeObj = urlencode($enUrlObj); // 再將解碼後的字串解序列化
        return $serializeObj;
    }

    // 將表單傳送的值解碼
    function de_url($values){
        $unUrlObj = urldecode($values); // 進行解碼
        $unserializeObj = unserialize(stripslashes($unUrlObj)); // 將解碼後的字串解序列化(還原初始資料結構)
        return $unserializeObj;
    }

    // JS的alert功能
    function alert($msg){
        js("alert('$msg');");
    }

    // 重新導向功能
	// $url: 要導向網址
	// $msg: 導向前的訊息(可選)
    function redirect($url, $msg = null){
		if(isset($msg)){
			js("
				if('$msg'){
					alert('$msg');
				};
				window.location.href = '$url';
				exit();
			");
		}else{
			js("
				window.location.href = '$url';
				exit();
			");
		}
        
    }

    // 執行JS功能
    function js($code){
        echo "<script>
                $code
            </script>";
    }
?>
