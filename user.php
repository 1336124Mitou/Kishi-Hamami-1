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


class User extends Dbdata
{
    public function NewUser($USID, $Name, $password, $ProInfo, $ProPic)
    {
    }
}
