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
                <h1 class="title"><a class="titleA" href="/">My Study records</a></h1>
            </div>
            
            <p><?php if (!empty($_SESSION)) echo $_SESSION['name']."Hello!"; ?></p>

            <div id="i" class="i">
                <a href="#fuu" class="secList"><i class="fa-solid fa-bars"></i></a>
            </div>
            
            <div class="headWrap">
                <ul id="fuu" class="left section">
                    <li><a class="link" href="./viewAll.php">All articles</a></li>
                    <li><a class="link" href="./viewCategory.php?num=1">Stock Investment</a></li>
                    <li><a class="link" href="./viewCategory.php?num=2">English</a></li>
                    <li><a class="link" href="./viewCategory.php?num=3">Others</a></li>
                    <li><a class="link" href="./viewCategory.php?num=0"><?php if (!empty($_SESSION)) echo "Private Articles";?></a></li>
                </ul>
                <ul class="right">
                    
                    <li><a class="link"href="./logout.php"><?php if (!empty($_SESSION)) echo "Log out";?></a></li>
                    <li><a class="link" href="./newForm.php"><?php if (!empty($_SESSION)) echo "Create New";?></a></li>
                </ul>
            </div>

            <h2 class="head">Recent Posts</h2>
            <div class="middleWrap">
                
                <div class="midTop">
                    <p>Title</p>
                    <p>Date Posted</p>
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
                        I am a person who wants to be independent of money.
                        So I study hard whenever I can!
                        To reach this goal I began to study Stock Investment recently.
                        I hope I will soon be able to get money.
                        And also I study English so as to get a job in a foreign country.
                        I'm very excited to imagine a day when I will work abroad.
                    </p>
                </div>
            </div>

            <h2 class="head">Contact</h2>
            <div class="contact">
                <div class="WhatIdo">
                    <p class="contacttext">If you want to make incredible WEBsite, please contact me!</p>
                </div>
                <div class="information">
                    <div class="emailTop">Email</div>
                    <div class="email">junbomelow@icloud.com</div>
                </div>

                <div class="contact_form">
                    <div id="message"></div>
                    <form method="post" action="/contact.php">
                        <div class="form-group">
                            <input name="name" id="name" type="text" class="form-control" placeholder="FirstName" >
                        </div>
                        <div class="form-group">
                            <input name="email" id="email" type="email" class="form-control" placeholder="SecondName" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" placeholder="Title" >
                        </div>
                        <div class="form-group">
                            <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Content"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-custom text-uppercase" value="Submit">
                            <div id="simple-msg"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <script src="/javascript/main.js"></script>
</body>
</html>
