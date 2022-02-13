<?php

Class Dbc 
{
    protected $table_name;

    protected function dbConnect() {
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
    public function getAll() {
        $dbh = $this->dbConnect();
        $sql="SELECT * FROM $this->table_name";
        $stmt=$dbh->prepare($sql);
    
        $dbh=null;
     //実行
        $stmt->execute();
    
        $all = $stmt->fetchAll();
        return $all;
    }
    
    //detailでブログ詳細画面表示
    public function getById($id) {
        $dbh = $this->dbConnect();
        if (empty($id)) {
            exit('IDが不正です。');
        }
        
        $stmt = $dbh->prepare("SELECT * FROM $this->table_name WHERE id = :id");
        $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if (!$result) {
            exit('ブログがありません。');
        }
        return $result;
    }
}

?>