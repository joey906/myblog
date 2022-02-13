<?php
require_once('./dbc.php');
Class Blog extends Dbc 
{
    protected $table_name = "Blogdata";

    //カテゴリ名表示
    public function setCategoryName($category){
        if ($category == '1'){
            return '日常';
        } elseif ($category == '2'){
            return 'プログラミング';
        } else {
            return 'その他';
        }
    }

    public function blogCreate($blog){
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