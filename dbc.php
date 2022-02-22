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
    
    //全ての投稿を表示
    public function getAll() {
        $dbh = $this->dbConnect();
        $sql="SELECT * FROM $this->table_name ORDER BY post_at DESC";
        $stmt=$dbh->prepare($sql);
    
        $dbh=null;
     //実行
        $stmt->execute();
    
        $all = $stmt->fetchAll();
        return $all;
    }

    //降順で最新の5つの投稿を用意
    public function getMaxFive(){
        $dbh = $this->dbConnect();
        $sql="SELECT * FROM $this->table_name WHERE published_status = 1 ORDER BY post_at DESC LIMIT 5";
        $stmt=$dbh->prepare($sql);
    
        $dbh=null;
     //実行
        $stmt->execute();
    
        $all = $stmt->fetchAll();
        return $all;
    }

    //カテゴリ別で全ての投稿を用意
    public function getCategoryPost($num) {
        $dbh = $this->dbConnect();
        $sql="SELECT * FROM $this->table_name WHERE category = $num ORDER BY post_at DESC";
        $stmt=$dbh->prepare($sql);
    
        $dbh=null;
     //実行
        $stmt->execute();
    
        $all = $stmt->fetchAll();
        return $all;
    }

    //published_statusが公開のものだけ表示
    public function getPublicBlog() {
        $dbh = $this->dbConnect();
        $sql="SELECT * FROM $this->table_name WHERE published_status = 1 ORDER BY post_at DESC";
        $stmt=$dbh->prepare($sql);
    
        $dbh=null;
     //実行
        $stmt->execute();
    
        $all = $stmt->fetchAll();
        return $all;
    }

    //非公開の記事を用意
    public function getPrivateBlog() {
        $dbh = $this->dbConnect();
        $sql="SELECT * FROM $this->table_name WHERE published_status = 2 ORDER BY post_at DESC";
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

    //投稿削除
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

    //XSS対策:エスケープ処理

    public function h($s) {
        return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }

    //サニタイジング処理
    public function sanitize_br($str){

        $str1 = str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $str);
        return nl2br($this->h($str1), true);
    
    }
}

?>