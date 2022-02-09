<?php
function dbConnect() {
try
{
    $dbs = "mysql:host=localhost;dbname=testdb;charset=utf8";
    $user='root';
    $password='root';
    $dbh=new PDO($dbs, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (Exception $e)
    {
        print '接続失敗'. $e->getMessage();
        exit();
    }
    return $dbh;
}

function getAllBlog() {
    $dbh = dbConnect();
    $sql='SELECT * FROM user';
    $stmt=$dbh->prepare($sql);

    $dbh=null;
//実行
    $stmt->execute();

    $all = $stmt->fetchAll();
    return $all;
}
$blogData = getAllBlog();


?>