<?php
require_once("./blog.php");
session_start();
ini_set('display_errors', 'On');
$blog = new Blog();
if (!empty($_SESSION)) {
    $blogData = $blog->getAll();
} else {
    $blogData = $blog->getPublicBlog();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ブログ一覧</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/top.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <div class="wrapper">
        <div class="container">
        <h1 class="title">ジョイの勉強ブログ</h1>
        <p><?php if (!empty($_SESSION)) echo $_SESSION['name']."こんにちは!"; ?></p>
        <ul class="nav">
            <li><a href="./login_form.php"><?php if (empty($_SESSION)) echo "ログイン";?></a></li>
            <li><a href="./logout.php"><?php if (!empty($_SESSION)) echo "ログアウト";?></a></li>
            <li><a href="./form.html"><?php if (!empty($_SESSION)) echo "新規作成";?></a></li>
        </ul>
        <table>
        <h2 class="head">ブログ一覧</h2>
            <tr>
                <th>タイトル</th>
                <th>カテゴリ</th>
                <th>投稿日時</th>
                <th>記事</th>
                <?php if (!empty($_SESSION)):?>
                    <th>投稿ステータス</th>
                    <th></th>
                    <th></th>
                <?php endif;?>
            </tr>
            <?php foreach($blogData as $column):?>
            <tr>
                <td><?php echo $blog->h($column["title"])?></td>
                <td><?php echo $blog->h($blog->setCategoryName($column["category"]))?></td>
                <td><?php echo $blog->h($column["post_at"])?></td>
                <td class="description"><a href="/detail.php?id=<?php echo $column["id"]?>">詳細</a></td>
                <?php if (!empty($_SESSION)):?>
                <td><?php echo $blog->setPublishStatus($column["published_status"])?></td>
                <?php endif;?>
                
                <?php if (!empty($_SESSION)):?>
                <td><a href="/update_form.php?id=<?php echo $column["id"]?>">編集</a></td>
                <td><a href="/blog_delete.php?id=<?php echo $column["id"]?>">削除</a></td>
                <?php endif;?>
            </tr>
            
            <?php endforeach;?>
            </table>
        </div>
    </div>
</body>
</html>
