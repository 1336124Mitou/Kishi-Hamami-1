<?php

// スーパークラスであるDbDataを利用
require_once __DIR__ . '/dbdata.php';

class Report extends Dbdata
{
    // 記事の内容を保存する
    public function addReport($RDet, $UsID)
    {
        $sql = "insert into report(Title, Naiyou, D, Tim) values( ?. ?. ?, ?)";
        $result = $this->exec($sql, [data("Y/m/d"), data("H:i"), $RDet, $UsID]);
    }

    // 記事を表示するためにすべてのデータを取り出す
    public function showAllReports()
    {
        $sql = "select * from question order by RepoID";
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
