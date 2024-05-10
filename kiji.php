<?php

// スーパークラスであるDbDataを利用
require_once __DIR__ . '/dbdata.php';

class Report extends Dbdata
{
    // 記事の内容を保存する
    public function addReport($RepoDet, $Title)
    {
        $sql = "insert into report(Title, info, D, Tim) values( ?, ?, ?, ?)";
        $result = $this->exec($sql, [$Title, $RepoDet, date("Y/m/d"), date("H:i")]);
    }

    // 記事を表示するためにすべてのデータを取り出す
    public function showAllReports()
    {
        $sql = "select * from report order by RepoID";
        $stmt = $this->query($sql, []);
        $showAll = $stmt->fetchAll();
        return $showAll;
    }

    // 与えられたRepoIdのデータを取り出す
    public function showReport($RepoID)
    {
        $sql = "select * from report where RepoID = ?";
        $stmt = $this->query($sql, [$RepoID]);
        $showR = $stmt->fetch();
        return $showR;
    }
}
