<?php

// スーパークラスであるDbDataを利用
require_once __DIR__ . '/dbdata.php';

class RU extends Dbdata
{
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

class User extends Dbdata
{
    public function NewUser($USID, $Name, $password, $ProInfo, $ProPic)
    {
        
    }
}