<?php

require_once __DIR__ . '/dbdata.php';

class User extends Dbdata
{
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

        // 新しいユーザーをデータベースに挿入
        $sql = "INSERT INTO usr(UsID, UsName, Passw, Prof, ProfPic) VALUES (?, ?, ?, ?, ?)";
        $this->exec($sql, [$UsID, $Name, $password, $ProInfo, $ProPic]);

        return true; // 登録成功を示す true を返す


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
    public function updateProfile($userId, $newUserName, $newBio) {
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
    
}

?>
