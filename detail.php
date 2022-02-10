<?php
require "./dbc.php";
$dbh = dbConnect();

$id = $_GET['id'];

if (empty($id)) {
    exit('IDが不正です。');
}

$stmt = $dbh->prepare('SELECT * FROM Blogdata WHERE id = :id');
$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    exit('ブログがありません。');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ詳細</title>
</head>
<body>
    <h2>ブログ詳細</h2>
    <h3>タイトル:<?php echo $result['title']?></h3>
    <p>投稿日時:<?php echo $result['post_at']?></p>
    <p>カテゴリ:<?php echo $result['category']?></p>
    <hr>
    <p>本文:<?php echo $result['content']?></p>
</body>
</html>