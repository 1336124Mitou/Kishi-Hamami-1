<?php

require_once __DIR__ . '/dbdata.php';

class UR extends Dbdata
{
    public function insertURlink($UsID, $RepoID)
    {
        // SQL query to insert data into USlink table with UsID and RepoID
        $sql = "INSERT INTO URlink (UsID, RepoID) VALUES (?, ?)";
        // Execute the SQL query with provided UsID and RepoID
        $result = $this->exec($sql, [$UsID, $RepoID]);
    }

    public function selectURlink($RepoID)
    {
        $sql = "SELECT * FROM URlink WHERE RepoID = ?";
        $stmt = $this->query($sql, [$RepoID]);
        $result = $stmt->fetch();

        return $result;
    }
}
// ユーザーのデータと制作物のデータを関連させる
class UP extends Dbdata
{
    public function insertUPlink($UsID, $ProID)
    {
        $sql = "INSERT INTO UPlink (UsID, ProID) VALUES (?, ?)";
        $result = $this->exec($sql, [$UsID, $ProID]);
    }
}
// ユーザーのデータと回答のデータを関連させる
class URe extends Dbdata
{
    public function insertURelink($UsID, $RepID)
    {
        $sql = "INSERT INTO URelink (UsID, RepID) VALUES (?, ?)";
        $result = $this->exec($sql, [$UsID, $RepID]);
    }

    // 特定のユーザーと回答/コメントのIDを取得する
    public function detailURelink($ComID)
    {
        $sql = "SELECT * FROM urelink WHERE RepID = ?";
        $stmt = $this->query($sql, [$ComID]);
        $result = $stmt->fetch();

        return $result;
    }
}
// ユーザーのデータと質問のデータを関連させる
class UQ extends Dbdata
{
    public function insertUQlink($UsID, $QuestionID)
    {
        $sql = "INSERT INTO UQlink (UsID, QuestionID) VALUES (?, ?)";
        $result = $this->exec($sql, [$UsID, $QuestionID]);
    }

    // 特定のユーザーと質問のIDを取得する
    public function detailUQlink($QID)
    {
        $sql = "SELECT * FROM UQlink WHERE QuestionID = ?";
        $stmt = $this->query($sql, [$QID]);
        $result = $stmt->fetch();

        return $result;
    }
}

class User extends Dbdata
{
    // 特定のユーザーのデータを取得する
    public function tokuteiUser($UID)
    {
        $sql = "SELECT * FROM usr WHERE UsID = ?";
        $stmt = $this->query($sql, [$UID]);
        $result = $stmt->fetch();

        return $result;
    }

    // 新しいユーザーを登録するメソッド
    public function newUser($UsID, $Name, $password, $passCheck, $ProInfo, $ProPic)
    {
        // 既に同じユーザーIDが存在するか確認
        $sql = "SELECT * FROM usr WHERE UsID = ?";
        $stmt = $this->query($sql, [$UsID]);
        $result = $stmt->fetch();

        if ($result) {
            // return 'この' . $USID . 'は既に登録されています。';
            return 1;
        }
        if ($password == $passCheck) {
            $sql = "INSERT INTO usr(UsID, UsName, Passw, Prof, ProfPic) values(?, ?, ?, ?, ?)";
            $result = $this->exec($sql, [$UsID, $Name, $password, $ProInfo, $ProPic]);
        } else {
            // return 'パスワードの入力が間違っています';
            return 2;
        }
    }

    // ログインをチェックするメソッド
    public function loginCheck($UsID, $pass)
    {
        // ユーザーIDとパスワードが一致するか確認
        $sql = "SELECT * FROM usr WHERE UsID = ? AND Passw = ?";
        $stmt = $this->query($sql, [$UsID, $pass]);
        $result = $stmt->fetch();

        return $result; // 結果を返す
    }

    // プロフィール情報を取得するメソッド
    public function myProfile($UsID)
    {
        // ユーザーIDに基づいてプロフィール情報を取得
        $sql = "SELECT * FROM usr WHERE UsID = ?";
        $stmt = $this->query($sql, [$UsID]);
        $result = $stmt->fetch();

        return $result; // 結果を返す
    }

    // パスワードを変更するメソッド
    public function passChange($UsID, $newPass)
    {
        // パスワードを更新
        $sql = "UPDATE usr SET Passw = ? WHERE UsID = ?";
        $this->exec($sql, [$newPass, $UsID]);

        // 更新後のユーザー情報を取得して返す
        $sql = "SELECT * FROM usr WHERE UsID = ?";
        $stmt = $this->query($sql, [$UsID]);
        $result = $stmt->fetch();

        return $result; // 更新後の情報を返す
    }

    // ユーザーのプロフィールを更新するメソッド
    public function updateProfile($userId, $newUserName, $newBio)
    {
        try {
            // データベースの更新処理を行う
            $sql = "UPDATE usr SET UsName = ?, Prof = ? WHERE UsId = ?";
            $stmt = $this->exec($sql, [$newUserName, $newBio, $userId]);

            // 更新された行数を確認
            if ($stmt->rowCount() > 0) {
                return true; // 更新成功
            } else {
                return false; // 更新なし
            }
        } catch (Exception $e) {
            // エラーハンドリング
            error_log("Error updating profile: " . $e->getMessage());
            return false;
        }
    }

    // ユーザーが投稿した質問を取得するメソッド
    public function getUserQuestions($userId)
    {
        $sql = "SELECT * FROM UQlink WHERE UsID = ?";
        $stmt = $this->query($sql, [$userId]); // ユーザーIDを正しく指定する
        $result = $stmt->fetchAll();

        return $result;
    }

    // ユーザーが投稿した記事を取得するメソッド
    public function getUserReports($userId)
    {
        $sql = "SELECT * FROM URlink WHERE UsID = ?";
        $stmt = $this->query($sql, [$userId]); // ユーザーIDを正しく指定する
        $result = $stmt->fetchAll();

        return $result;
    }

    // ユーザーが投稿した質問の内容を取得するメソッド
    public function getUserQuestionsInfo($userId)
    {
        $sql = "SELECT q.Question
                FROM UQlink uq
                JOIN Question q ON uq.QuestionID = q.QuestionID
                WHERE uq.UsID = ?";
        $stmt = $this->query($sql, [$userId]);
        $result = $stmt->fetchAll();

        return $result;
    }

    // ユーザーが投稿した記事のタイトルを取得するメソッド
    public function getUserReportTitles($userId)
    {
        // ユーザーが投稿した記事のIDを取得
        $sql = "SELECT r.Title 
                FROM URlink ur
                JOIN Report r ON ur.RepoID = r.RepoID
                WHERE ur.UsID = ?";
        $stmt = $this->query($sql, [$userId]);
        $result = $stmt->fetchAll();

        return $result;
    }
}
