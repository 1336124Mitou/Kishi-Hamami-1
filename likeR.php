<?php

require_once __DIR__ . '/dbdata.php';

class LikeRepo extends Dbdata
{
    public function addLikeR($RepoID)
    {
        $sql = "UPDATE Reply SET LNum = LNum + 1 WHERE RepID = ?";
        $result = $this->exec($sql, [$RepoID]);
    }

    public function showLikeR($RepoID)
    {
        $sql = "SELECT LNum FROM Reply Where RepID = ?";
        $stmt = $this->query($sql, [$RepoID]);
        $showLike = $stmt->fetch();
        return $showLike;
    }
}
