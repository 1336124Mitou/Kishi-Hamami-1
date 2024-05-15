<?php

require_once __DIR__ . '/dbdata.php';

class LikeRepo extends Dbdata
{
    public function addLikeR($RepoID)
    {
        $sql = "UPDATE Report SET LNum = LNum + 1 WHERE RepoID = ?";
        $result = $this->exec($sql, [$RepoID]);
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