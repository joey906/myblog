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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://kit.fontawesome.com/3d715e0df8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <?php if (!empty($_SESSION)):?>
    <div class="wrapper">
        <div class="container">
        <h1 class="title"><a class="titleA" href="/">ジョイの勉強ブログ</a></h1>
        <p><?php if (!empty($_SESSION)) echo $_SESSION['name']."こんにちは!"; ?></p>

            <div id="i" class="i">
                <a href="#fuu" class="secList"><i class="fa-solid fa-bars"></i></a>
            </div>
            
            <div class="headWrap">
                <ul id="fuu" class="left section">
                    <li><a class="link" href="./viewAll.php">記事一覧</a></li>
                    <li><a class="link" href="./viewCategory.php?num=1">英語</a></li>
                    <li><a class="link" href="./viewCategory.php?num=2">プログラミング</a></li>
                    <li><a class="link" href="./viewCategory.php?num=3">AWS</a></li>
                    <li><a class="link" href="./viewCategory.php?num=0"><?php if (!empty($_SESSION)) echo "非公開記事";?></a></li>
                </ul>
                <ul class="right">
                    
                    <li><a class="link"href="./logout.php"><?php if (!empty($_SESSION)) echo "ログアウト";?></a></li>
                    <li><a class="link" href="./newForm.php"><?php if (!empty($_SESSION)) echo "新規作成";?></a></li>
                </ul>
            </div>
        <table>
        <h2 class="head">ブログ一覧</h2>
            <tr>
                <th>タイトル</th>
                <th>カテゴリ</th>
                <th>投稿日時</th>
                <?php if (!empty($_SESSION)):?>
                    <th>投稿ステータス</th>
                    <th></th>
                    <th></th>
                <?php endif;?>
            </tr>
            <?php foreach($blogData as $column):?>
            <tr>
                <td><a class="link" href="/detail.php?id=<?php echo $column["id"]?>"><?php echo $blog->h($column["title"])?></a></td>
                <td><?php echo $blog->h($blog->setCategoryName($column["category"]))?></td>
                <td><?php echo $blog->h($column["post_at"])?></td>
                <?php if (!empty($_SESSION)):?>
                    <td><?php echo $blog->setPublishStatus($column["published_status"])?></td>
                    <td><a class="link" href="/update_form.php?id=<?php echo $column["id"]?>">編集</a></td>
                    <td><a class="link" href="/blog_delete.php?id=<?php echo $column["id"]?>">削除</a></td>
                <?php endif;?>
            </tr>
            <?php endforeach;?>
        </table>
        </div>
    </div>
    <?php else:?>
        <div class="wrapper">
        <div class="container">
            <h1 class="title"><a class="titleA" href="/">ジョイの勉強ブログ</a></h1>
            <p><?php if (!empty($_SESSION)) echo $_SESSION['name']."こんにちは!"; ?></p>

            <div id="i" class="i">
                <a href="#fuu" class="secList"><i class="fa-solid fa-bars"></i></a>
            </div>
            
            <div class="headWrap">
                <ul id="fuu" class="left section">
                    <li><a class="link" href="./viewAll.php">記事一覧</a></li>
                    <li><a class="link" href="./viewCategory.php?num=1">英語</a></li>
                    <li><a class="link" href="./viewCategory.php?num=2">プログラミング</a></li>
                    <li><a class="link" href="./viewCategory.php?num=3">AWS</a></li>
                    <li><a class="link" href="./viewCategory.php?num=0"><?php if (!empty($_SESSION)) echo "非公開記事";?></a></li>
                </ul>
                <ul class="right">
                    
                    <li><a class="link"href="./logout.php"><?php if (!empty($_SESSION)) echo "ログアウト";?></a></li>
                    <li><a class="link" href="./newForm.php"><?php if (!empty($_SESSION)) echo "新規作成";?></a></li>
                </ul>
            </div>

            <h2 class="head">All Posts</h2>
            <div class="middleWrap">
                
                <div class="midTop">
                    <p>タイトル</p>
                    <p>投稿日</p>
                </div>
                <?php foreach($blogData as $column):?>
                <a href="/detail.php?id=<?php echo $column["id"]?>">
                <div class="midLeft">
                    <p class="text">
                    <?php echo $blog->h($column["title"])?>
                    </p>
                    <p class="text">
                    <?php echo $blog->h($column["post_at"])?>
                    </p>  
                </div>
                </a>
                <?php endforeach;?>
            </div>
            <a href="/">戻る</a>
        </div>
    <?php endif;?>
    <script src="/javascript/main.js"></script>
</body>
</html>
