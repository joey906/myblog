<?php

require_once "./blog.php";

$id = $_GET['id'];
$blog = new Blog();
$result = $blog->delete($id);

?>

<p><a href="/">戻る</a></p>