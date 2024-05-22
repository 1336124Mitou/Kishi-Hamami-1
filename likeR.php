<?php

require_once __DIR__ . '/dbdata.php';

class LikeRepo extends Dbdata
{
    public function addLikeR($RepoID, $UID) {
        try {
            $this->beginTransaction();

            $sql = "SELECT * FROM likes WHERE UsID = ? AND RepoID = ?";
            $stmt = $this->query($sql, [$UID, $RepoID]);
            $result = $stmt->fetch();

            if (!$result) {
                $sql = "UPDATE Report SET LNum = LNum + 1 WHERE RepoID = ?";
                if (!$this->exec($sql, [$RepoID])) {
                    throw new Exception("Failed to update LNum");
                }

                $sql = "INSERT INTO likes (UsID, RepoID) VALUES (?, ?)";
                if (!$this->exec($sql, [$UID, $RepoID])) {
                    throw new Exception("Failed to insert into likes table");
                }
            } else {
                $sql = "UPDATE Report SET LNum = LNum - 1 WHERE RepoID = ?";
                if (!$this->exec($sql, [$RepoID])) {
                    throw new Exception("Failed to update LNum");
                }

                $sql = "DELETE FROM likes WHERE RepoID = ? AND UsID = ?";
                if (!$this->exec($sql, [$RepoID, $UID])) {
                    throw new Exception("Failed to delete from likes table");
                }
            }

            $this->commit();
            return true;
        } catch (Exception $e) {
            $this->rollBack();
            error_log("Transaction failed: " . $e->getMessage());
            throw $e;
        }
    }


    public function showLikeR($RepoID)
    {
        $sql = "SELECT LNum FROM Report Where RepoID = ?";
        $stmt = $this->query($sql, [$RepoID]);
        $showLike = $stmt->fetch();
        return $showLike;
    }
}

/*
class LikeCom extends Dbdata
{
    public function addlikeC($ComID)
    {
        $sql = "UPDATE"
    }
}
*/