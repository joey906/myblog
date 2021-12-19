<?php
echo 'majide'. '<br>';
try
{
$dbs = "mysql:host=localhost;dbname=testdb;charset=utf8";
$user='root';
$password='root';
$dbh=new PDO($dbs, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql='SELECT * FROM user';
$stmt=$dbh->prepare($sql);

$dbh=null;
//実行
$stmt->execute();

$all = $stmt->fetchAll();
//配列を表示
foreach($all as $loop){
  echo $loop['id']." ".$loop['name'].'<br>';
}

}
catch (Exception $e)
{
        print '接続失敗'. $e->getMessage();
        exit();
}
?>
