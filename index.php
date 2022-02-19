<?php
require_once("./blog.php");
session_start();
ini_set('display_errors', 'On');
$blog = new Blog();
$blogData = $blog->getMaxFive();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>topPage</title>
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
            <div class="headWrap">
                <ul class="left">
                    <li><a href="./viewAll.php">記事一覧</a></li>
                    <li><a href="./viewCategory.php?num=1">日常</a></li>
                    <li><a href="./viewCategory.php?num=2">プログラミング</a></li>
                    <li><a href="./viewCategory.php?num=0"><?php if (!empty($_SESSION)) echo "非公開記事";?></a></li>
                </ul>
                <ul class="right">
                    <li><a href="./login_form.php"><?php if (empty($_SESSION)) echo "ログイン";?></a></li>
                    <li><a href="./logout.php"><?php if (!empty($_SESSION)) echo "ログアウト";?></a></li>
                    <li><a href="./newForm.php"><?php if (!empty($_SESSION)) echo "新規作成";?></a></li>
                </ul>
            </div>

            <h2 class="head">Recent Posts</h2>
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

            <h2 class="head">About Me</h2>
            <div class="about">
                <div class="photo">
                    <img src="./photo/cosmos.png" class="img">
                </div>
                <div class="description">
                    <p class="abouttext">
                        エンジニアを目指しているジョイです！
                        まだエンジニアの卵ですが、早くヒヨコになれるよう日々勉強中です。
                        日々の勉強のアウトプットの場所としてブログを作りました。
                        主にプログラミングに関することやインフラ関係、また英語に関する
                        ことをアップしていきます。
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
