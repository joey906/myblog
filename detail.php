<?php
require_once "./blog.php";

$id = $_GET['id'];
$blog = new Blog();
$result = $blog->getById($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/detail.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://kit.fontawesome.com/3d715e0df8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>ブログ詳細</title>
</head>
<body>
    <div class="wrapper">
        <div class="container">
        <h2 class="head">ブログ詳細</h2>
    <h3>タイトル:<?php echo $result['title']?></h3>
    <p>投稿日時:<?php echo $result['post_at']?></p>
    <p>カテゴリ:<?php echo $blog->setCategoryName($result['category'])?></p>
    <hr>
    <p>本文：</p>
    <p class="mainTxt"><?php echo $blog->sanitize_br($result['content'])?></p>
    <p><a href="/">戻る</a></p>
        </div>
    </div>
    
</body>
</html>