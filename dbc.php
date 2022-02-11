<?php

//データベースコネクション
function dbConnect() {
    try
    {
       $dbs = "mysql:host=localhost;dbname=Blogdb;charset=utf8";
        $user='root';
        $password='root';
        $dbh=new PDO($dbs, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    catch (Exception $e)
    {
        print '接続失敗'. $e->getMessage();
        exit();
    }
    return $dbh;
}

//index.phpで全ての投稿を表示
function getAllBlog() {
    $dbh = dbConnect();
    $sql='SELECT * FROM Blogdata';
    $stmt=$dbh->prepare($sql);

    $dbh=null;
 //実行
    $stmt->execute();

    $all = $stmt->fetchAll();
    return $all;
}

//カテゴリ名表示
function setCategoryName($category){
    if ($category == '1'){
        return '日常';
    } elseif ($category == '2'){
        return 'プログラミング';
    } else {
        return 'その他';
    }
}

//detailでブログ詳細画面表示
function getBlog($id) {
    $dbh = dbConnect();
    if (empty($id)) {
        exit('IDが不正です。');
    }
    
    $stmt = $dbh->prepare('SELECT * FROM Blogdata WHERE id = :id');
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$result) {
        exit('ブログがありません。');
    }
    return $result;
}

?>