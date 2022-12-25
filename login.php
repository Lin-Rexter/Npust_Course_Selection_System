<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登錄頁面</title>
</head>
<body>
    
    <form method='POST' action='login_action.php'>
    帳號:<input required type='text' name='student_id'><br>
    密碼:<input required type='text' name='password'><br>
    <input type='submit' value='send'>
    <input type='reset' value='reset'>
    <a href='register.php'>註冊</a>
</body>
</html>