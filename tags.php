<?php

require_once __DIR__ . '/dbdata.php';

class Tag extends DbData {
    // すべてのタグを表示するための関数
    public function showTags() {
        $sql = "select * from tags order by TagID";
        $stmt = $this->query($sql, []);
        $showTags = $stmt->fetchAll();
        return $showTags;
    }

    // 質問とタグのIDを利用して、関連する関数
    public function addTagQ($QuestionID, $TagID) {
        $sql = "INSERT INTO questiontags (QuestionID, TagID) VALUES (?, ?)";
        $stmt = $this->exec($sql, [$QuestionID, $TagID]);
    }

    // 記事とタグのIDを利用して、関連する関数
    public function addTagR($RepoID, $TagID) {
        $sql = "INSERT INTO RepoTags (RepoID, TagID) VALUES (?, ?)";
        $stmt = $this->exec($sql, [$RepoID, $TagID]);
    }
}