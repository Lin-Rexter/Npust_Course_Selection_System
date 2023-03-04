<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>NPUST模擬選課系統-註冊</title>
    <link rel='icon' href='' type='image/x-icon' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0,shrink-to-fit=no,user-scalable=yes" />
    <meta name="description" content="NPUST屏科大模擬選課系統-註冊頁面" />
    <meta name="author" content="第十組">

    <!--Meta Robots SEO-->
    <meta name='robots' content='max-image-preview:large' />

    <!--Style CDN (Bootstrap)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--Style Custom-->
    <link rel="stylesheet" href="../../styles/Custom.css">
    <link rel="stylesheet" href="../../styles/RWD.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" as="font" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
</head>

<body>
    <main class="container-fluid">
        <div class="sign_up">
            <!-- logo -->
            <div class="row justify-content-center mt-0 mb-1 mb-sm-3 align-items-center">
                <img class='col-8 img-fluid' src="https://wp.npust.edu.tw/wp-content/uploads/2019/08/cropped-npust-log_%E5%B7%A5%E4%BD%9C%E5%8D%80%E5%9F%9F-1.png" alt="NPUST-屏東科技大學 Logo" title="NPUST-屏東科技大學 Logo" />
            </div>

            <!-- 標題 -->
            <div class="row justify-content-center align-items-center m-0 p-0 my-1 my-sm-3" title="NPUST 模擬選課系統-註冊享受豐富功能">
                <hr class='col-12 move-to-right mt-0 mb-auto'>
                <div class="row align-items-center my-2">
                    <p class='col-12 col-sm-6 text-center fw-bold fs-2 m-0'>NPUST 模擬選課系統</p>
                    <p class='col-12 col-sm-1 text-center fw-bold fs-1 m-0'>✖</p>
                    <p class='col-12 col-sm-5 text-center fw-bold fs-2 m-0'><span class='text-warning bg-secondary p-1 py-2 rounded-2 position-relative' style="top:0.5px">註冊</span>享受豐富功能</p>
                </div>
                <hr class='col-12 move-to-left mb-0 mt-auto'>
            </div>

            <!-- 填寫區塊 -->
            <form class="row gx-5 gx-md-5 gy-3 gy-sm-4 justify-content-center m-0 p-0 px-sm-5 my-sm-3" method='POST' action=''>
                <!-- 輸入框 -->
                <div class="col-sm-12 floating-content">
                    <input type="text" title="輸入使用者帳號名稱" class="form-control floating-input" id="username" name='username' placeholder=" " required>
                    <label for="username" class="floating-label" id="user_label">
                        <i class="fa-solid fa-user"></i>
                        帳號
                    </label>
                </div>
                <div class="col-sm-6 floating-content">
                    <input type="password" title="輸入密碼" class="form-control floating-input" id="password" name='password' placeholder=" " required>
                    <label for="password" class="floating-label" id="pass_label">
                        <i class="fa-solid fa-lock"></i>
                        密碼
                    </label>
                </div>
                <div class="col-sm-6 floating-content">
                    <input type="password" title="再次輸入密碼" class="form-control floating-input" id="re_password" name='re_password' placeholder=" " required>
                    <label for="re_password" class="floating-label" id="re_pass_label">
                        <i class="fa-solid fa-lock"></i>
                        確認密碼
                    </label>
                </div>
                <div class="col-sm-6 floating-content">
                    <input type="text" title="輸入電子郵件" class="form-control floating-input" id="email" name='email' placeholder=" " required>
                    <label for="email" class="floating-label" id="email_label">
                        <i class="fa-solid fa-envelope"></i>
                        Email
                    </label>
                </div>
                <div class="col-sm-6 floating-content">
                    <input type="text" title="輸入學號(可選)" class="form-control floating-input" id="student_id" placeholder=" " name='student_id'>
                    <label for="student_id" class="floating-label" id="student_id_label">
                        <i class="fa-solid fa-id-card"></i>
                        學號(可選)
                    </label>
                </div>

                <!-- 註冊按鈕 -->
                <div class='col-12 col-sm-6 col-md-6 d-flex justify-content-center justify-content-sm-end mt-4 mt-sm-5'>
                    <button type="submit" title="註冊按鈕" formaction="./action/Signup_action.php" class='soft_btn_green btn btn-success fw-bold fs-4 un border border-3 border-success rounded-4'>
                        <i class="fa-solid fa-heart fs-3"></i>
                        註冊(Sign in)
                    </button>
                </div>
                <!-- 登入按鈕 -->
                <div class='col-12 col-sm-6 col-md-6 d-flex justify-content-center justify-content-sm-start mt-4 mt-sm-5'>
                    <a href='./Login.php' title="登入按鈕" target="_self" class='soft_btn_blue btn btn-primary fw-bold fs-4 un border border-3 border-primary rounded-4'>
                        <i class="fa-solid fa-right-to-bracket fs-3"></i>
                        轉至登入(Log in)
                    </a>
                </div>
            </form>
        </div>

        <!-- 彈出提示框(警告用) -->
        <div class="mytoast-3">
            <div id="liveToast-Waring" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                <!-- 標題 -->
                <div class="toast-header m-3 soft_title_white">
                    <img src="" class="me-2" alt="">
                    <strong class="me-auto fs-2 text-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        警告
                    </strong>
                </div>
                <!-- 內容 -->
                <div class="toast-body">
                    <!-- 自訂訊息 -->
                    <p class="fw-bold fs-3 px-4">
                        <span id="toast_message"></span>
                    </p>
                    <!-- 按鈕 -->
                    <div align="center" class="mt-3 toast-body-style-1">
                        <button type="button" class="btn btn-primary btn-sm px-3 fs-3 un-green" data-bs-dismiss="toast">確認</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--Bootstrap JS-->
    <script nonce="random123" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <script src="../../scripts/signUp.js"></script>
    <script src="../../scripts/toast.js"></script>
    <script>
        // 彈出提示框(警告)
        var toast_Waring = document.getElementById('liveToast-Waring'); // 提示框
        var message = document.getElementById('toast_message'); // 寫入訊息

        function toast(messages) {
            Toast(toast_Waring, message, messages);
        }

        Disable_Spacebar(); // 禁用空白鍵輸入

        const username = new Validation('username', 'user_label', '輸入長度至少5位!', 5);
        username.enable(); // 啟用警告功能

        const password = new Validation('password', 'pass_label', '請輸入至少6位英數或特殊符號!', 6);
        password.enable();

        const re_password = new Validation('re_password', 're_pass_label', '輸入值請與密碼相同!', 're', 'password');
        re_password.enable();

        const email = new Validation('email', 'email_label', '請輸入有效的電子郵件!', 'mail');
        email.enable();

        const student_id = new Validation('student_id', 'student_id_label', '請輸入有效的學號!', 'student');
        student_id.enable();
    </script>

    <!-- 用於顯示註冊錯誤訊息 -->
    <?php
    require('../../module/other.php'); // 其他功能模組

    $en_mes = $_GET['en_mes'] ?? false;
    $en_arr = de_url($en_mes) ?? false;

    // 當沒有值時，設為false
    $en_arr['err_name'] ??= false;
    $en_arr['err_mail'] ??= false;
    $en_arr['err_SID'] ??= false;
    $en_arr['err_account'] ??= false;

    $err_mes = array([
        $en_arr['err_name'] ? "已存在相同帳號!" : false,
        $en_arr['err_mail'] ? "已存在相同電子郵件!" : false,
        $en_arr['err_SID'] ? "已存在相同學號!" : false,
        $en_arr['err_account'] ? "註冊帳號失敗!" : false
    ]);

    $err_messages = "";
    foreach ($err_mes[0] as $row) {
        if ($row) {
            // 當為帳號註冊錯誤訊息，顯示系統錯誤訊息
            if($en_arr['err_account']){
                $err_messages .= '<h3 class="text-danger fw-bold soft_text_white py-2 px-3"><i class="fa-solid fa-triangle-exclamation"></i>' . $en_arr['err_account'] . '</h3>';
            }
            $err_messages .= '<h3 class="text-danger fw-bold soft_text_white py-2 px-3"><i class="fa-solid fa-triangle-exclamation"></i>' . $row . '</h3>';
        }
    }

    if ($err_messages) {
        js("toast('$err_messages');");
    }
    ?>

    <!--Font Awesome JS-->
    <script nonce="random123" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>