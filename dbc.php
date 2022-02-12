<?php

Class Dbc 
{
    function dbConnect() {
        try
        {
           $dbs = "mysql:host=localhost;dbname=Blogdb;charset=utf8";
            $user='root';
            $password='root';
            $dbh=new \PDO($dbs, $user, $password);
            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
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
        $dbh = $this->dbConnect();
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
        $dbh = $this->dbConnect();
        if (empty($id)) {
            exit('IDが不正です。');
        }
        
        $stmt = $dbh->prepare('SELECT * FROM Blogdata WHERE id = :id');
        $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if (!$result) {
            exit('ブログがありません。');
        }
        return $result;
    }

    function blogCreate($blog){
        $sql = 'INSERT INTO 
            Blogdata(title, content, category, published_status)
        VALUES
            (:title, :content, :category, :published_status)';

        $dbh = $this->dbConnect();
        $dbh->beginTransaction();
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blog['title'], PDO::PARAM_STR);
            $stmt->bindValue(':content', $blog['content'], PDO::PARAM_STR);
            $stmt->bindValue(':category', $blog['category'], PDO::PARAM_INT);
            $stmt->bindValue(':published_status', $blog['publish_status'], PDO::PARAM_INT);
            $stmt->execute();
            $dbh->commit();
            echo 'ブログを投稿しました！';
        } catch(PDOException $e) {
            $dbh->rollBack();
            exit($e);
        }

    }
}

?>