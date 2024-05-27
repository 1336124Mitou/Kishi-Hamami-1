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
    public function query($sql, $array_params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($array_params);
        return $stmt; // PDOステートメントオブジェクトを返すのでfetch(), fetchAll()で結果セットを取得
    }

    // INSERT、UPDATE、DELETE文実行用のメソッド
    public function exec($sql, $array_params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($array_params); // 成功：true、失敗：false
        return $stmt;
    }

    protected function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    protected function commit()
    {
        $this->pdo->commit();
    }

    public function getLastInsertedID()
    {
        return $this->pdo->lastInsertId();
    }

    public function rollBack()
    {
        $this->pdo->rollBack();
    }
}
