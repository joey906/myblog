<?php
require_once("./env.php");
Class Dbc 
{
    protected $table_name;
    protected $table_name2;

    protected function dbConnect() {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        try
        {
            $dbs = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $dbh=new \PDO($dbs, $user, $pass);
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

    public function delete($id){
        $dbh = $this->dbConnect();
        if (empty($id)) {
            exit('IDが不正です。');
        }
        
        $stmt = $dbh->prepare("DELETE FROM $this->table_name WHERE id = :id");
        $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);
        $stmt->execute();
        echo 'ブログを削除しました';
        return $result;
    }
}

?>