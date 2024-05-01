<?php

require_once __DIR__ . '/dbdata.php';

class Comment extends Dbdata
{
    public function addCom($Com, $QuestionID)
    {
        $sql_reply = "INSERT INTO Reply (Reply, D, Tim) VALUES (?, ?, ?)";
        $result_reply = $this->exec($sql_reply, [$Com, date("Y-m-d"), date("H:i:s")]);

        if ($result_reply) {
            // Replyテーブルにデータの保存がうまくいけば、INSERT INTO RepQ文を実行する
            $RepID = $this->getLastInsertedID(); // 最後に入力された質問のIDを取得する
            $sql_repq = "INSERT INTO RepQ (RepID, QuestionID) VALUES (?, ?)";
            $result_repq = $this->exec($sql_repq, [$RepID, $QuestionID]);

            if ($result_repq) {
                return true; // 両方のINSERTが成功しました。
            } else {
                // Rollback the insertion into Reply table since insertion into RepQ failed
                // INSERT INTO RepQが失敗したので、INSERT INTO Replyに戻します。
                $this->rollbackLastInsert();
                return false; // INSERT INTO RepQが失敗しました
            }
        } else {
            return false; // INSERT INTO Replyが失敗しました
        }
    }

    public function showAllAnswer($QID)
    {
        $sql = "select * from Reply where RepID in (select RepID from RepQ where QuestionID = ?)";
        $stmt = $this->query($sql, [$QID]);
        $rep = $stmt->fetchAll();
        return $rep;
    }
}
