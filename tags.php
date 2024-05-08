<?php

require_once __DIR__ . '/dbdata.php';

class Tag extends DbData {
    public function showTags() {
        $sql = "select * from tags order by TagID";
        $stmt = $this->query($sql, []);
        $showTags = $stmt->fetchAll();
        return $showTags;
    }

    public function addTagQ($QuestionID, $TagID) {
        $sql = "INSERT INTO questiontags (QuestionID, TagID) VALUES (?, ?)";
        $stmt = $this->exec($sql, [$QuestionID, $TagID]);
    }
}