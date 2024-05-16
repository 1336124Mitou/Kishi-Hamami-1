<?php

// スーパークラスであるDbDataを利用
require_once __DIR__ . '/dbdata.php';

// ユーザーのデータと記事のデータを関連させる
class UR extends Dbdata
{
    public function insertURlink($UsID, $RepoID)
    {
        // SQL query to insert data into USlink table with UsID and RepoID
        $sql = "INSERT INTO URlink (UsID, RepoID) VALUES (?, ?)";

        // Execute the SQL query with provided UsID and RepoID
        $result = $this->exec($sql, [$UsID, $RepoID]);
    }
}

// ユーザーのデータと制作物のデータを関連させる
class UP extends Dbdata
{
    public function insertUPlink($UsID, $ProID)
    {
        $sql = "INSERT INTO UPlink (UsID, ProID) VALUES (?, ?)";
        $result = $this->exec($sql, [$UsID, $ProID]);
    }
}

// ユーザーのデータと回答のデータを関連させる
class URe extends Dbdata
{
    public function insertURelink($UsID, $RepID)
    {
        $sql = "INSERT INTO URelink (UsID, RepID) VALUES (?, ?)";
        $result = $this->exec($sql, [$UsID, $RepID]);
    }
}

// ユーザーのデータと質問のデータを関連させる
class UQ extends Dbdata
{
    public function insertUQlink($UsID, $QuestioinID)
    {
        $sql = "INSERT INTO UQlink (UsID, Qustion) VALUES (?, ?)";
        $result = $this->exec($sql, [$UsID, $QuestioinID]);
    }
}

class User extends Dbdata
{
    public function NewUser($USID, $Name, $password, $ProInfo, $ProPic)
    {
    }
}
