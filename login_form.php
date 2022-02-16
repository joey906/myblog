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
        <p>名前：</p>
        <input type="text" name="name">
        <p>パスワード：</p>
        <input type="password" name="pass">
        <input type="submit" value="送信">
    </form>
</body>
</html>