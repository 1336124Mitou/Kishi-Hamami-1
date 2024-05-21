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
        //コメントのIDをしゅとく
        $sql = "SELECT * FROM RepR WHERE RepoID = ?";
        $stmt = $this->query($sql, [$RepoID]);
        $RepIDs = $stmt->fetchAll();

        //記事とユーザーの関連を削除
        $sql = "DELETE FROM URlink WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);

        //記事のいいねを削除
        $sql = "DELETE FROM Likes WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);

        //記事とコメントの関連を削除
        $sql = "DELETE FROM RepR WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);

        //記事とタグの削除
        $sql = "DELETE FROM RepoTags WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);

        //記事を削除
        $sql = "DELETE FROM Report WHERE RepoID = ?";
        $this->exec($sql, [$RepoID]);

        //記事のコメントを削除
        foreach ($RepIDs as $RepID) {
            $sql = "DELETE FROM Reply WHERE RepID = ?";
            $this->exec($sql, [$RepID['RepID']]);
        }
    }
}
