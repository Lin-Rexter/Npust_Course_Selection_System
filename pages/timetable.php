<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生課表</title>
</head>
<body>
    <?php
    include ('sql.php');
    session_start();
    $sId = $_SESSION['sId'];
    $name = $_SESSION['name'];
    echo "<center>";
    echo "<table border='1'>
        <tr align='center'>
        <td>節次/星期</td>
        <td>星期一</td>
        <td>星期二</td>
        <td>星期三</td>
        <td>星期四</td>
        <td>星期五</td>
        <td>星期六</td>
        <td>星期日</td>
        </tr>
        <tr align='center'>
        <td>1</td>
        <td></td>
        <td></td>   
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr align='center'>
        <td>2</td>
        <td></td>
        <td></td>   
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr align='center'>
        <td>3</td>
        <td></td>
        <td></td>   
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr align='center'>
        <td>4</td>
        <td></td>
        <td></td>   
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr align='center'>
        <td>5</td>
        <td></td>
        <td></td>   
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr align='center'>
        <td>6</td>
        <td></td>
        <td></td>   
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr align='center'>
        <td>7</td>
        <td></td>
        <td></td>   
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr align='center'>
        <td>8</td>
        <td></td>
        <td></td>   
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        </table>";
    echo "<a href='main.php'>首頁</a>";
    echo "</center>";
    ?>
</tr>
</html>