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
    <link rel="stylesheet" href="style/Custom.css">
    <link rel="stylesheet" href="style/RWD.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" as="font" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
</head>

<body class="vh-100">
    <?php
    require('./module/connect.php'); // 載入連線模組
    require('./module/mysql.php'); // 載入資料庫操作模組
    require('./module/other.php'); // 其他功能模組

    $link = new Mysql($link); // 進行連線

    // 啟用session
    session_start();
    $_SESSION['name'] = ''; // 使用者帳號名稱
    $_SESSION['aId'] = ''; // 帳號資料庫id
    $_SESSION['sId'] = ''; // 學生資料庫id
    $_SESSION['student_id'] = ''; // 學號
    $name = $_SESSION['name'];

    $c_s_result = $link->select(['*', 'course']);

    $rows = $c_s_result[1]->fetch_all(MYSQLI_ASSOC);
    ?>

    <div class="container panel">
        <!-- 網頁加載動畫 -->
        <div>
        </div>
        <header id="Header" class="row opacity-75">
            <!-- 導覽列 -->
            <nav id="Nav" class="col p-3 navbar navbar-expand-lg navbar-light bg-light d-inline-flex">

                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav d-flex p-2 me-auto fw-bold">
                        <li class="nav-item">
                            <a class="nav-link mx-3 un" aria-current="page" href=".\home.php">首頁</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-3 un" href=".\login.php">登入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-3 un" href=".\my_profile.php">個人資料</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="ticker-container">
                <div id="ticker">
                    <p>歡迎來到屏科大模擬選課系統，本系統除了可以讓你選課之外，還可以讓你討論課程內容，讓你知道哪一個課程最適合你</p>
                </div>
            </div>
        </header>

        <!-- 主要區塊 -->
        <main id="Main" class="row opacity-75 justify-content-center">
            <!-- 上區塊 -->
            <div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9 mb-5 myWidth">
                <article class="p-3 border border-3 border-white rounded rounded-5 justify-content-center" align='center'>
                <?php
                    if(isset($name)){
                        echo"
                            <h2 class='fw-bold'>立即註冊，即可使用更多進階功能!</h2>
                            <button type='button' class='btn btn-outline-danger'> 
                                <a href='#' class='text-reset'> 註冊 </a>
                            </button>
                            ";
                    }
                ?>
                </article>
            </div>

            <!-- 下區塊 -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <article class="p-5 border border-3 border-white rounded rounded-5 justify-content-center" align='center'>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>
                                    <h1>課程代碼</h1>
                                </th>
                                <th>
                                    <h1>開課系所</h1>
                                </th>
                                <th>
                                    <h1>授課教師</h1>
                                </th>
                                <th>
                                    <h1>課程名稱</h1>
                                </th>
                                <th>
                                    <h1>開課狀態</h1>
                                </th>
                                <th>
                                    <h1>班級</h1>
                                </th>
                                <th>
                                    <h1>學分</h1>
                                </th>
                                <th>
                                    <h1>修別(必、選)</h1>
                                </th>
                                <th>
                                    <h1>上課時數</h1>
                                </th>
                                <th>
                                    <h1>上課星期</h1>
                                </th>
                                <th>
                                    <h1>上課節次</h1>
                                </th>
                                <th>
                                    <h1>教室代號</h1>
                                </th>
                                <th>
                                    <h1>加入課表</h1>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($c_s_result[0]) {
                                foreach ($rows as $row) {
                                    echo "
                                    <form action='' method='GET'>
                                        <tr class='justify-content-center table-primary'>
                                            <td>{$row['course_id']}</td>
                                            <td>{$row['department']}</td>
                                            <td>{$row['teacher']}</td>
                                            <td>{$row['course_name']}</td>
                                            <td>{$row['course_status']}</td>
                                            <td>{$row['class_name']}</td>
                                            <td>{$row['credit']}</td>
                                            <td>{$row['subject']}</td>
                                            <td>{$row['course_hours']}</td>
                                            <td>{$row['day_of_week']}</td>
                                            <td>{$row['period']}</td>
                                            <td>{$row['class_id']}</td>
                                            <td>
                                                <input class='btn btn-outline-info p-3' type='submit' onclick=\"this.form.action=''\" name='add' value='加入'/>
                                            </td>
                                        </tr>
                                    </form>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </article>
            </div>

            <!--彈出提示框(警告用)-->
            <div class="mytoast-3">
                <div id="liveToast-Waringg" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                    <!-- 標題 -->
                    <div class="toast-header">
                        <img src="" class="me-2" alt="">
                        <strong class="me-auto fs-2 text-danger"><i class="fa-solid fa-triangle-exclamation"></i>警告</strong>
                        <small id="Time" class="fs-4"></small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <!-- 內容 -->
                    <div class="toast-body">
                        <p class="fw-bold fs-3"><span id="host_name_Waringg"></span></p>
                    </div>
                </div>
            </div>
        </main>

        <footer>

        </footer>

    </div>

    <!--Font Awesome JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>