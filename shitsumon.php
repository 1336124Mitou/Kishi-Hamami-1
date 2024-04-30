<?php

// スーパークラスであるDbDataを利用するため
require_once __DIR__ . '/dbdata.php';

class Quest extends DbData
{
    // 質問の内容を保存します
    public function addQuestion($QDet, $UsID)
    {
        $sql = "insert into question(D, Tim, Question, UsID) values( ?, ?, ?, ?)"; // 質問内容と投稿時刻を表示する
        $result = $this->exec($sql, [date("Y/m/d"), date("H:i"), $QDet, $UsID]);
    }

    // 質問を表示するするためにすべてのデータを取り出す
    public function showAllQuestions() {
        $sql = "select * from question order by QuestionID";
        $stmt = $this->query($sql, []);
        $showAll = $stmt->fetchAll();
        return $showAll;
    }
}
