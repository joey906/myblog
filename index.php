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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="https://kit.fontawesome.com/3d715e0df8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="wrapd">
            <h1 class="title"><a class="titleA" href="/">ジョイの勉強ブログ</a></h1>
            </div>
            
            <p><?php if (!empty($_SESSION)) echo $_SESSION['name']."こんにちは!"; ?></p>

            <div id="i" class="i">
                <a href="#fuu" class="secList"><i class="fa-solid fa-bars"></i></a>
            </div>
            
            <div class="headWrap">
                <ul id="fuu" class="left section">
                    <li><a class="link" href="./viewAll.php">記事一覧</a></li>
                    <li><a class="link" href="./viewCategory.php?num=1">日常</a></li>
                    <li><a class="link" href="./viewCategory.php?num=2">プログラミング</a></li>
                    <li><a class="link" href="./viewCategory.php?num=0"><?php if (!empty($_SESSION)) echo "非公開記事";?></a></li>
                </ul>
                <ul class="right">
                    
                    <li><a class="link"href="./logout.php"><?php if (!empty($_SESSION)) echo "ログアウト";?></a></li>
                    <li><a class="link" href="./newForm.php"><?php if (!empty($_SESSION)) echo "新規作成";?></a></li>
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
                    <p class="text time">
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
    <script src="/javascript/main.js"></script>
</body>
</html>
