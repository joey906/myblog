<?php
require_once("./blog.php");

$blog = new Blog();
$blog->logout();
var_dump($_SESSION);
?>
<p><a href="/">戻る</a></p>