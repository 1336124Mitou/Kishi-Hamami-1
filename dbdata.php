<?php
class Dbdata
{
    protected $pdo;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=kishi;charset=utf8';
        $user = 'Kishi';
        $password = 'hamami';
        try {
            $this->pdo = new PDO($dsn, $user, $password);
        } catch (Exception $e) {
            echo 'Error:' . $e->getMessage();
            die();
        }
    }

    // SELECT文実行用のメソッド
    protected function query($sql, $array_params)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($array_params);
        return  $stmt;  // PDOステートメントオブジェクトを返すのでfetch( )、fetchAll( )で結果セットを取得									
    }

    // INSERT、UPDATE、DELETE文実行用のメソッド	
    protected function exec($sql,  $array_params)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($array_params);  // 成功：true、失敗：false
        return  $stmt;
    }
}
