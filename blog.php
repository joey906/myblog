<?php
require_once('./dbc.php');
Class Blog extends Dbc 
{
    protected $table_name = "Blogdata";
    protected $table_name2 = "users";

    //カテゴリ名表示
    public function setCategoryName($category){
        if ($category == '1'){
            return '英語';
        } elseif ($category == '2'){
            return 'プログラミング';
        } else {
            return '非公開記事';
        }
    }

    public function setEnglishCategory($category) {
        if ($category == '1'){
            return 'English';
        } elseif ($category == '2'){
            return 'programing';
        } else {
            return '非公開記事';
        }
    }

    //公開状態表示
    public function setPublishStatus($status){
        if ($status == '1'){
            return '公開';
        } else {
            return '非公開';
        }
    }

    public function blogCreate($blog){
        $sql = "INSERT INTO 
            $this->table_name(title, content, category, published_status)
        VALUES
            (:title, :content, :category, :published_status)";

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
    
    public function blogUpdate($blogs) {
        $sql = "UPDATE $this->table_name SET 
            title = :title, content = :content, category = :category, published_status = :published_status
        WHERE
            id = :id";

        $dbh = $this->dbConnect();
        $dbh->beginTransaction();
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
            $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
            $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
            $stmt->bindValue(':published_status', $blogs['publish_status'], PDO::PARAM_INT);
            $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT);
            $stmt->execute();
            $dbh->commit();
            echo 'ブログを更新しました！';
        } catch(PDOException $e) {
            $dbh->rollBack();
            exit($e);
        }
    }

    //ログイン機能
    public function login($loginInfo){
        $pass = $loginInfo['pass'];
        $name = $loginInfo['name'];
        $dbh = $this->dbConnect();
        $stmt = $dbh->prepare("SELECT * FROM $this->table_name2 WHERE name LIKE :name");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            exit('ユーザー名が間違っています');
        }

        if (password_verify($pass, $result['password'])) {
            session_start();
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['email'] = $result['email'];
            var_dump($_SESSION);
            echo 'ログインしました';
        } else {
            echo 'パスワードが違います';
            var_dump($result);
        }
    }

    public function logout(){
        $_SESSION = array();
        session_start();
        session_destroy();
        echo 'ログアウトしました';
    }

    //ブログのバリデーション
    public function blogValidate($blogs) {
        if (empty($blogs['title'])) {
            exit('タイトルを入力してください');
        }
        
        if (mb_strlen($blogs['title']) > 191) {
            exit('タイトルは191文字以下にしてください');
        }
        
        if (empty($blogs['content'])) {
            exit('本文を入力してください');
        }
        
        if (empty($blogs['category'])) {
            exit('カテゴリーは必須です');
        }
        
        if (empty($blogs['publish_status'])) {
            exit('公開ステータスは必須です');
        }
    }

    //ログインのバリデーション
    public function loginValidate($loginInfo) {
        if (empty($loginInfo['name'])){
            exit('名前を入力してください');
        }

        if (empty($loginInfo['pass'])){
            exit('パスワードを入力してください');
        }
    }

    //管理者のバリデーション
    public static function authValidate() {
        session_start();
        if (!isset($_SESSION['name'])) {
            exit('ログインしていません');
        }
    }
}
?>