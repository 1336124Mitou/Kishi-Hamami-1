<?php

// スーパーくらであるDBdataを利用
require_once __DIR__ . '/dbdata.php';

class Comment extends Dbdata
{
    // 記事コメントの内容を保存する
    public function addComment($Com, $RDet)
    {
        $sql = "insert into report";
    }
}
