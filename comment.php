<?php

require_once __DIR__ . '/dbdata.php';

class Comment extends Dbdata
{
    public function addCom($kiji, $RepoID)
    {
        $sql_report = "INSERT INTO Reply (Reply, D, Tim) VALUES (?, ?, ?)";
        $result_report = $this->exec($sql_report, [$kiji, date("Y-m-d"), date("H:i:s")]);

        if ($result_report) {
            // Reportテーブルにデータの保存がうまくいけば、INSERT INTO RepR文を実行する
            $RepID = $this->getLastInsertedID(); // 最後に入力された記事のIDを取得する
            $sql_repr = "INSERT INTO RepR (RepID, RepoID) VALUES (?, ?)";
            $result_repr = $this->exec($sql_repr, [$RepID, $RepoID]);

            if ($result_repr) {
                return true; // 両方のINSERTが成功しました。
            } else {
                // Rollback the insertion into Report table since insertion into RepR failed
                // INSERT INTO RepRが失敗したので、INSERT INTO Reportに戻します。
                $this->rollbackLastInsert();
                return false; // INSERT INTO RepRが失敗しました
            }
        } else {
            return false; // INSERT INTO Reportが失敗しました
        }
    }

    public function showAllAnswer($RID)
    {
        $sql = "select * from Reply where RepID in (select RepID from RepR where RepoID = ?)";
        $stmt = $this->query($sql, [$RID]);
        $rep = $stmt->fetchAll();
        return $rep;
    }
}
