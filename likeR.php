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

class LikeCom extends Dbdata
{
    public function addLikeC($RepID, $UID) {
        try {
            $this->beginTransaction();
    
            $sql = "SELECT * FROM likes WHERE UsID = ? AND RepID = ?";
            $stmt = $this->query($sql, [$UID, $RepID]);
            $result = $stmt->fetch();
    
            if (!$result) {
                $sql = "UPDATE Reply SET LNum = LNum + 1 WHERE RepID = ?";
                if (!$this->exec($sql, [$RepID])) {
                    throw new Exception("Failed to update LNum");
                }
    
                $sql = "INSERT INTO likes (UsID, RepID) VALUES (?, ?)";
                if (!$this->exec($sql, [$UID, $RepID])) {
                    throw new Exception("Failed to insert into likes table");
                }
            } else {
                $sql = "UPDATE Reply SET LNum = LNum - 1 WHERE RepID = ?";
                if (!$this->exec($sql, [$RepID])) {
                    throw new Exception("Failed to update LNum");
                }
    
                $sql = "DELETE FROM likes WHERE RepID = ? AND UsID = ?";
                if (!$this->exec($sql, [$RepID, $UID])) {
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
    

    public function showLikeRep($RepID)
    {
        $sql = "SELECT LNum FROM Reply Where RepID = ?";
        $stmt = $this->query($sql, [$RepID]);
        $showLike = $stmt->fetch();
        return $showLike;
    }

    public function liked($RepID, $UID) {
        $sql = "SELECT * FROM likes WHERE UsID = ? AND RepID = ?";
        $stmt = $this->query($sql, [$UID, $RepID]);
        $result = $stmt->fetch();
        if (!$result) {
            return false;
        } else {
            return true;
        }
    }
}