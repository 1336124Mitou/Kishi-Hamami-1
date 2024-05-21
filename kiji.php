<?php

// スーパークラスであるDbDataを利用
require_once __DIR__ . '/dbdata.php';

class Report extends Dbdata
{
    // 記事の内容を保存する
    public function addReport($RepoDet, $Title)
    {
        $sql = "insert into report(Title, info, D, Tim) values( ?, ?, ?, ?)";
        $result = $this->exec($sql, [$Title, $RepoDet, date("Y/m/d"), date("H:i:s")]);

        $lastRID = $this->pdo->lastInsertId();

        return $lastRID;
    }

    // 記事を表示するためにすべてのデータを取り出す
    public function showAllReports()
    {
        $sql = "select * from report";
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

    public function deleteReport($RepoID)
    {
        $sql = "DELETE FROM URlink WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);

        $sql = "DELETE FROM Likes WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);

        $sql = "DELETE FROM RepR WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);

        $sql = "DELETE FROM RepoTags WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);

        $sql = "DELETE FROM Report WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);
    }
}
