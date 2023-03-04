<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>NPUST模擬選課系統-首頁</title>
    <link rel='icon' href='' type='image/x-icon' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0,shrink-to-fit=no,user-scalable=yes" />
    <meta name="description" content="NPUST屏科大模擬選課系統" />
    <meta name="author" content="第十組">

    <!--Meta Robots SEO-->
    <meta name='robots' content='max-image-preview:large' />

    <!-- Facebook Open Graph -->
    <meta property="og:title" content="NPUST模擬選課系統-首頁" />
    <meta property="og:type" content="website" />
    <meta property="fb:app_id" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:alt" content="" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:site_name" content="NPUST模擬選課系統-首頁" />
    <meta property="og:description" content="NPUST屏科大模擬選課系統" />
    <!-- Twitter Open Graph -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="第十組" />
    <meta name="twitter:creator" content="第十組" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:title" content="NPUST模擬選課系統-首頁" />
    <meta name="twitter:description" content="NPUST屏科大模擬選課系統" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:image:alt" content="" />
    <link rel="canonical" href="" />

    <!--Style CDN (Bootstrap)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--Style Custom-->
    <link rel="stylesheet" href="./styles/Custom.css">
    <link rel="stylesheet" href="./styles/RWD.css">

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
    <?php
    require('./module/connect.php'); // 載入連線模組
    require('./module/mysql.php'); // 載入資料庫操作模組
    require('./module/other.php'); // 其他功能模組

    $link = new Mysql($link); // 進行連線

    // 啟用session，檢查是否為登入狀態
    session_start();
    $IS_LOGIN = $_SESSION['is_login'] ?? false;
    $USERNAME = $_SESSION['npust_username'] ?? false;

    $c_s_result = $link->select(['*', 'course']);

    $rows = $c_s_result[1]->fetch_all(MYSQLI_ASSOC);
    ?>

    <!-- 粒子動畫 -->
    <div id="particles-js"></div>
    <!-- RWD容器 -->
    <div id="rwd" class="container d-flex flex-column justify-content-center align-items-stretch">
        <!-- 頁首 -->
        <header id="Header" class="row mt-3 p-3">
            <!-- 導覽列 -->
            <nav id="Nav" class="p-3 navbar navbar-expand-lg navbar-light d-inline-flex rounded-4">
                <!-- 行動版摺疊按鈕 -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="row-12 navbar-nav d-flex flex-nowrap fw-bold fs-3">
                        <li class="nav-item">
                            <a class="nav-link mx-3 un" aria-current="page" href=".\home.php">首頁</a>
                        </li>
                        <?php
                        if (!$IS_LOGIN) {
                            echo "
                            <li class='ms-3 ms-sm-0 nav-item dropdown'>
                                <a class='nav-link un' id='navbarDropdownMenuLink' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>
                                    登入/註冊
                                    <i class='fa-solid fa-caret-down fs-2'></i>
                                    <i class='fa-solid fa-caret-up fs-2'></i>
                                </a>

                                <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                    <li class='dropdown-item un'>
                                        <a class='nav-link mx-3' href='./pages/Login&Signup/Login.php'>登入</a>
                                    </li>
                                    <li class='dropdown-item un'>
                                        <a class='nav-link mx-3' href='./pages/Login&Signup/Signup.php'>註冊</a>
                                    </li>
                                </ul>
                            </li>
                            ";
                        }
                        ?>
                        <li class='nav-item'>
                            <a class='nav-link mx-3 un' href='.\my_profile.php'>我的小屋</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link mx-3 un' href='.\timetable.php'>我的課程表</a>
                        </li>
                        <?php
                        if ($IS_LOGIN) {
                            echo "
                            <li class='nav-item'>
                                <a class='nav-link mx-3 un' href='./pages/Login&Signup/Logout.php'>登出</a>
                            </li>";
                        }
                        ?>
                    </ul>
                </div>
                <button type='button' id='dark_mode' class='light'>🌓</button>
            </nav>
        </header>

        <!-- 跑馬燈 -->
        <div class="row ticker-container">
            <div class="col" id="ticker">
                <p class='fw-bold fs-1'>歡迎來到屏科大模擬選課系統，本系統除了可以讓你選課之外，還可以讓你討論課程內容，讓你知道哪一個課程最適合你</p>
            </div>
        </div>

        <!-- 主要區塊 -->
        <main id="Main" class="row justify-content-center">
            <!-- 上區塊 -->
            <div class="col-11 col-sm-10 col-md-8 col-lg-8 col-xl-7 col-xxl-7 justify-content-center">
                <article class="mb-5 mt-4 p-3 border border-5 border-warning rounded rounded-5 justify-content-center border-start-0 border-end-0" align='center'>
                    <?php
                    if ($IS_LOGIN) {
                        echo "
                        <h1 class='fw-bold'><span id='Auto_write'></span></h1>
                        ";
                    } else {
                        echo "
                            <h2 class='fw-bold'><span id='Auto_write'></span></h2>
                            <button type='button' class='btn btn-outline-danger fw-bold fs-3'>
                                <a href='./pages/Login&Signup/Signup.php' class='text-reset text-decoration-none'>註冊</a>
                            </button>
                            <button type='button' class='btn btn-outline-info fw-bold fs-3'>
                                <a href='./pages/Login&Signup/Login.php' class='text-reset text-decoration-none'>登入</a>
                            </button>
                            ";
                    }
                    ?>
                </article>
            </div>

            <!-- 下區塊 -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 justify-content-center">
                <article class=" p-5 border border-3 border-white rounded rounded-5 justify-content-center" align='center'>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-4 justify-content-center">
                        <?php
                        if ($c_s_result[0]) {
                            foreach ($rows as $row) {
                                echo "
                                    <div class='col'>
                                        <div class='card' style='width: 25rem;'>
                                            <img src='https://2020tecphfair.nsysu.edu.tw/file/dw/rbiVE6CCTjeaBj4u' class='card-img-top' alt='...'>
                                            <form action='' method='GET'>
                                                <div class='card-body'>
                                                    <h5 class='card-title'>{$row['course_name']}</h5>
                                                    <p class='card-text'>{$row['course_id']} | {$row['teacher']}</p>
                                                    <input class='btn btn-outline-success p-3 fw-bold fs-4' type='submit' onclick=\"this.form.action=''\" name='detail' value='詳細'/>
                                                    <input class='btn btn-outline-info p-3 fw-bold fs-4' type='submit' onclick=\"this.form.action=''\" name='add' value='加入'/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                ";
                            }
                        }
                        ?>
                    </div>
                </article>
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

            <!-- 彈出提示框(提示用) -->
            <div class="mytoast-3">
                <div id="liveToast-tip" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                    <!-- 標題 -->
                    <div class="toast-header m-3 soft_title_white">
                        <img src="" class="me-2" alt="">
                        <strong class="me-auto fs-2 text-success">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            提示
                        </strong>
                    </div>
                    <!-- 內容 -->
                    <div class="toast-body">
                        <!-- 自訂訊息 -->
                        <p class="fw-bold fs-3 px-4">
                            <span id="toast_message_tip"></span>
                        </p>
                        <!-- 按鈕 -->
                        <div align="center" class="mt-3 toast-body-style-1">
                            <button type="button" class="btn btn-primary btn-sm px-3 fs-3 un-green" data-bs-dismiss="toast">確認</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- 頁尾 -->
        <footer id="Footer" class="row justify-content-start">
            <div class="col">
                <h2>更新於2023/01/11 13:53</h2>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- 自動打字 -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="./scripts/toast.js"></script>
    <script>
        // 彈出提示框(警告)
        var toast_Waring = document.getElementById('liveToast-Waring'); // 提示框
        var message = document.getElementById('toast_message'); // 寫入訊息

        // 彈出提示框(提示)
        var toast_tip = document.getElementById('liveToast-tip'); // 提示框
        var message_tip = document.getElementById('toast_message_tip'); // 寫入訊息

        function toast(messages, tip = null) {
            if (tip) {
                Toast(toast_tip, message_tip, messages);
            } else {
                Toast(toast_Waring, message, messages);
            }
        }

        var typed = new Typed("#Auto_write", {
            strings: [
                "<?php
                    // 取得使用者帳號註冊日期，來切換歡迎訊息
                    $get_create_time = $link->select(['create_time', 'account', "WHERE BINARY username='$USERNAME'"]);
                    if ($get_create_time[0]) {
                        $time_rows = $get_create_time[1]->fetch_all(MYSQLI_ASSOC);
                        $create_time = strtotime($time_rows[0]['create_time']);

                        $now_time = strtotime(date('Y-m-d H:i:s'));
                        $now = date('Y-m-d H:i');

                        // 檢查註冊的日期是否已超過特定時間
                        if ($now_time - $create_time < 60) {
                            echo "親愛的{$USERNAME}新會員 感謝註冊!";
                        } else {
                            echo "親愛的{$USERNAME}會員你好! 歡迎使用本平台💖<br>現在的時間是 <span class='text-info'>{$now}</spam>";
                        }
                    }

                    if (!$IS_LOGIN) {
                        echo "未成為會員? 立即註冊，即可使用更多進階功能!";
                    }
                    ?>"
            ], // 裡面有^1000、^500 是延遲的秒數
            typeSpeed: 70, // 打字速度
            backSpeed: 60, // 刪除速度
            startDelay: 1200, // 延遲開始
            backDelay: 5000, // 延遲刪除
            cursorChar: "✏️", // 游標樣式
            smartBackspace: true, // 預設，智慧刪除功能，隨意
            loop: false // 不斷重複
        });

        let dark_mode = document.getElementById('dark_mode'); // 暗黑模式按鈕
        let rwd = document.getElementById('rwd'); // 暗黑模式樣式的位置

        // 解析cookie
        function parseCookie() {
            var cookieObj = {};
            var cookieAry = document.cookie.split(';');
            var cookie;

            for (var i = 0, l = cookieAry.length; i < l; ++i) {
                cookie = cookieAry[i].trim();
                cookie = cookie.split('=');
                cookieObj[cookie[0]] = cookie[1];
            }

            return cookieObj;
        }

        // 從cookie中取得特定名稱屬性值
        function getCookieByName(name) {
            var value = parseCookie()[name];
            if (value) {
                value = decodeURIComponent(value);
            }

            return value;
        }

        function dark() {
            dark_mode.classList.remove('light')
            dark_mode.classList.add('dark')
            dark_mode.innerText = "🌓";
            rwd.classList.add('filter');
        }

        function light() {
            dark_mode.classList.remove('dark')
            dark_mode.classList.add('light')
            dark_mode.innerText = "🌞";
            rwd.classList.remove('filter');
        }

        var dark_value = getCookieByName('dark');

        if (dark_value == 'on') {
            dark();
        } else if (dark_value == 'off') {
            light();
        }

        // 暗黑模式按鈕點擊偵測
        dark_mode.addEventListener('click', function() {
            if (dark_mode.classList.contains('light')) {
                dark();
                document.cookie = "dark=on";
            } else if (dark_mode.classList.contains('dark')) {
                light();
                document.cookie = "dark=off";
            }
        });
    </script>

    <?php
    // 判斷是否已出現提示過
    if (!isset($_SESSION['has_reply']) && !$_SESSION['has_reply']) {
        // 檢查登入成功與否
        if (isset($_GET['en_mes_login'])) {
            $logout_success = de_url($_GET['en_mes_login']);
            if ($logout_success['login']) {
                js("toast('登入成功!', true);");
                $_SESSION['has_reply'] = true;
            }
        }

        // 檢查登出成功與否
        if (isset($_GET['en_mes_logout'])) {
            $logout_success = de_url($_GET['en_mes_logout']);
            $logout_success['logout'] ? js("toast('登出成功!', true);") : js("toast('登出失敗! 請再重新登出一次!');");
            $_SESSION['has_reply'] = true;
        }
    }
    ?>

    <!-- 背景粒子動畫particles.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js" integrity="sha512-Kef5sc7gfTacR7TZKelcrRs15ipf7+t+n7Zh6mKNJbmW+/RRdCW9nwfLn4YX0s2nO6Kv5Y2ChqgIakaC6PW09A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./scripts/particles.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>