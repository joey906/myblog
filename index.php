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


if (!empty($_SESSION)) {
    echo $_SESSION['name']."こんにちは!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>
</head>
<body>
    <h2>ブログ一覧</h2>
    <p><a href="./login_form.php"><?php if (empty($_SESSION)) echo "ログイン";?></a></p>
    <p><a href="./logout.php"><?php if (!empty($_SESSION)) echo "ログアウト";?></a></p>
    <p><a href="./form.html"><?php if (!empty($_SESSION)) echo "新規作成";?></a></p>
    <table>
        <tr>
            <th>タイトル</th>
            <th>カテゴリ</th>
            <th>投稿日時</th>
            <?php if (!empty($_SESSION)):?>
                <th>投稿ステータス</th>
            <?php endif;?>
        </tr>
        <?php foreach($blogData as $column):?>
        <tr>
            <td><?php echo $blog->h($column["title"])?></td>
            <td><?php echo $blog->h($blog->setCategoryName($column["category"]))?></td>
            <td><?php echo $blog->h($column["post_at"])?></td>
            <?php if (!empty($_SESSION)):?>
            <td><?php echo $blog->setPublishStatus($column["published_status"])?></td>
            <?php endif;?>
            <td><a href="/detail.php?id=<?php echo $column["id"]?>">詳細</a></td>
            <?php if (!empty($_SESSION)):?>
            <td><a href="/update_form.php?id=<?php echo $column["id"]?>">編集</a></td>
            <td><a href="/blog_delete.php?id=<?php echo $column["id"]?>">削除</a></td>
            <?php endif;?>
        </tr>
        <?php endforeach;?>
    </table>
</body>
</html>
