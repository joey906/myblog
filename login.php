<?php
require_once("./blog.php");
ini_set('display_errors', 'On');
$loginInfo = $_POST;

$blog = new Blog();
$blog->loginValidate($loginInfo);
$blog->login($loginInfo);

?>
<br>
<a href="/">戻る</a>
