<?php

require_once __DIR__ . '/dbdata.php';

class Tag extends DbData
{
    // すべてのタグを表示するための関数
    public function showTags()
    {
        $sql = "select * from tags order by TagID";
        $stmt = $this->query($sql, []);
        $showTags = $stmt->fetchAll();
        return $showTags;
    }

    // 質問とタグのIDを利用して、関連する関数
    public function addTagQ($QuestionID, $TagID)
    {
        $sql = "INSERT INTO questiontags (QuestionID, TagID) VALUES (?, ?)";
        $stmt = $this->exec($sql, [$QuestionID, $TagID]);
    }

    // 記事とタグのIDを利用して、関連する関数
    public function addTagR($RepoID, $TagID)
    {
        $sql = "INSERT INTO RepoTags (RepoID, TagID) VALUES (?, ?)";
        $stmt = $this->exec($sql, [$RepoID, $TagID]);
    }

    // 質問IDから質問一覧にタグを表示するための関数
    public function showTagQ($QuestionID)
    {
        $sql = "select * from Tags where TagID in (select TagID from questiontags where QuestionID = ?)";
        $stmt = $this->query($sql, [$QuestionID]);
        $showTagQ = $stmt->fetch();
        return $showTagQ;
    }

    // 質問の絞り込みをするための関数
    public function sortTagQ($TagID) {
        $sql = "select * from Question where QuestionID in (select QuestionID from questiontags where TagID = ?";
        $stmt = $this->query($sql, [$TagID]);
        $rep = $stmt->fetchAll();
        return $rep;
    }
}
