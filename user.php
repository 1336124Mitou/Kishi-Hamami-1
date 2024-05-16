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
    public function NewUser($USID, $Name, $password, $passCheck, $ProInfo, $ProPic)
    {
        $sql = "SELECT * FROM usr WHERE UsID = ?";
        $stmt = $this->query($sql, [$USID]);
        $result = $stmt->fetch();
        if ($result) {
            return 'この'. $USID . 'は既に登録されています。';
        }
        if ($password == $passCheck) {
            $sql = "INSERT INTO usr(UsID, UsName, Passw, Prof, ProfPic) values(?, ?, ?, ?, ?)";
            $result = $this->exec($sql, [$USID, $Name, $password, $ProInfo, $ProPic]);
        } else {
            return 'パスワードの入力が間違っています';
        }
    }
}