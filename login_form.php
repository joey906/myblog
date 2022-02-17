<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginForm</title>
</head>
<body>
    <h2>ログインフォーム</h2>
    <form action="./login.php" method="POST">
        <p>
            <label for="name">名前：</label>
            <input type="text" name="name">
        </p>
       
        <p>
            <label for="password">パスワード：</label>
            <input type="password" name="pass">
        </p>
        
        <input type="submit" value="ログイン">
    </form>
    <a href="/">戻る</a>
</body>
</html>