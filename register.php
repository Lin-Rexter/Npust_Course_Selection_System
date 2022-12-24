<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method='POST' action='register_action.php'>
    姓名:<input required type='text' name='name'><br>
    學號/帳號:<input required type='text' name='id'><br>    
    密碼:<input required type='text' name='password'><br>
    確認密碼:<input required type='text' name='ps'><br>
    生日:<input required type='date' name='birthday'><br>
    年級:<input required type='number' name='grade'><br>
    <input type='submit' value='send'>
    <form>
</body>
</html>