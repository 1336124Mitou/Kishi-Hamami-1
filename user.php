<?php

// スーパークラスであるDbDataを利用
require_once __DIR__ . '/dbdata.php';

class RU extends Dbdata
{
    public function logincheck($UsID, $pass)
    {
        $sql = "select * from Usr where UsID = ? and Passw = ?";
        $stmt = $this->query($sql, [$UsID, $pass]);
        $result = $stmt->fetch();
        return $result;
    }
    public function insertUSlink($UsID, $RepoID)
    {
        // Uslinkテーブルになんかするやつ
        try {
            // sql文
            $sql = "INSERT INTO USlink (UsID, RepoID) VALUES (?, ?)";
            // パラメータの設定
            $array_params = array($UsID, $RepoID);
            // 実行
            $this->exec($sql, $array_params);
        } catch (Exception $e) {
            echo "エラー:" . $e->getMessage();
        }
    }
}
