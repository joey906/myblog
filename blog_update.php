<?php
require_once "./blog.php";
ini_set('display_errors', 'On');
$blogs = $_POST;

$blog = new Blog();
$blog->blogValidate($blogs);
$blog->blogUpdate($blogs);
?>