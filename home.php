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
    <header>

    </header>

    <article>

    </article>

    <footer>

    </footer> 

    <?php
    require('./module/connect.php'); // 載入連線模組
    require('./module/mysql.php'); // 載入資料庫操作模組
    require('./module/other.php'); // 其他功能模組

    $link = new Mysql($link); // 進行連線

    // 啟用session
    session_start();
    $_SESSION['name'] = '請先登錄'; // 使用者帳號名稱
    $_SESSION['aId'] = ''; // 帳號資料庫id
    $_SESSION['sId'] = ''; // 學生資料庫id
    $_SESSION['student_id'] = ''; // 學號
    $name = $_SESSION['name'];

    echo "你好，$name" . "<br>";
    echo "歡迎來到屏科大模擬選課系統，本系統除了可以讓你選課之外，還可以讓你討論課程內容，讓你知道哪一個課程最適合你";

    $c_s_result = $link -> select(['*', 'course']);

    if ($c_s_result[0]) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>課程代碼</td>";
        echo "<td>開課系所</td>";
        echo "<td>授課教師</td>";
        echo "<td>課程名稱</td>";
        echo "<td>開課狀態</td>";
        echo "<td>班級</td>";
        echo "<td>學分</td>";
        echo "<td>修別(必、選)</td>";
        echo "<td>上課時數</td>";
        echo "<td>上課星期</td>
        <td>上課節次</td>
        ";
        echo "<td>教室代號</td>";
        echo "</tr>";
        $rows = $c_s_result[1]->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row){
            echo "<tr>";
            echo "<td>" . $row['course_id'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['teacher'] . "</td>";
            echo "<td>" . $row['course_name'] . "</td>";
            echo "<td>" . $row['course_status'] . "</td>";
            echo "<td>" . $row['class_name'] . "</td>";
            echo "<td>" . $row['credit'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['course_hours'] . "</td>";
            echo "<td>" . $row['day_of_week'] . "</td>";
            echo "<td>" . $row['period'] . "</td>";
            echo "<td>" . $row['class_id'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='login.php'>登錄</a>";
    }
    ?>

    <!--Font Awesome JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>