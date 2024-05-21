<?php

// スーパークラスであるDbDataを利用するため
require_once __DIR__ . '/dbdata.php';

class Quest extends DbData
{
    // 質問の内容を保存します
    public function addQuestion($QDet, $UsID)
    {
        $sql = "INSERT INTO question(D, Tim, Question, UsID) VALUES( ?, ?, ?, ?)"; // 質問内容と投稿時刻を表示する
        $result = $this->exec($sql, [date("Y/m/d"), date("H:i"), $QDet, $UsID]);

        // 最後に入力された質問のIDを取得する
        $lastQId = $this->pdo->lastInsertId();

        return $lastQId; // 最後に入力された質問のIDを返す
    }

    // 質問を表示するするためにすべてのデータを取り出す
    public function showAllQuestions()
    {
        $sql = "select * from question order by QuestionID";
        $stmt = $this->query($sql, []);
        $showAll = $stmt->fetchAll();
        return $showAll;
    }

    //与えられたQuestionIDのデータを取り出す
    public function showQuestion($QID)
    {
        $sql = "select * from question WHERE QuestionID = ?";
        $stmt = $this->query($sql, [$QID]);
        $showQ = $stmt->fetch();
        return $showQ;
    }

    public function deleteQuestion($QID)
    {
        $sql = "DELETE FROM UQlink WHERE QuestionID = ?";
        $this->exec($sql, [$QID]);

        $sql = "DELETE FROM RepQ WHERE QuestionID = ?";
        $this->exec($sql, [$QID]);

        $sql = "DELETE FROM QuestionTags WHERE QuestionID = ?";
        $this->exec($sql, [$QID]);

        $sql = "DELETE FROM Question WHERE QuestionID = ?";
        $this->exec($sql, [$QID]);
    }
}
