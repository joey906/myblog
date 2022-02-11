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

$sql = 'INSERT INTO 
            Blogdata(title, content, category, published_status)
        VALUES
            (:title, :content, :category, :published_status)';

$dbh = dbConnect();

try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':title', $blog['title'], PDO::PARAM_STR);
    $stmt->bindValue(':content', $blog['content'], PDO::PARAM_STR);
    $stmt->bindValue(':category', $blog['category'], PDO::PARAM_INT);
    $stmt->bindValue(':published_status', $blog['publish_status'], PDO::PARAM_INT);
    $stmt->execute();
} catch(PDOException $e) {
    exit($e);
}

?>