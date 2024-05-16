<?php

// スーパークラスであるDbDataを利用
require_once __DIR__ . '/dbdata.php';

class RU extends Dbdata
{
    public function insertUSlink($UsID, $RepoID)
    {
        // sql文
        $sql = "INSERT INTO USlink (UsID, RepoID) VALUES (?, ?)";
    }
}

class User extends Dbdata
{
    public function NewUser($USID, $Name, $password, $ProInfo, $ProPic)
    {
    }
}
