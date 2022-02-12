<?php
require "./dbc.php";
$blog = $_POST;

if (empty($blog['title'])) {
    exit('タイトルを入力してください');
}

if (mb_strlen($blog['title']) > 191) {
    exit('タイトルは191文字以下にしてください');
}

if (empty($blog['content'])) {
    exit('本文を入力してください');
}

if (empty($blog['category'])) {
    exit('カテゴリーは必須です');
}

if (empty($blog['publish_status'])) {
    exit('公開ステータスは必須です');
}

$dbc = new Dbc();
$dbc->blogCreate($blog);
?>