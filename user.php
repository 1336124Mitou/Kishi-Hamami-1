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
            return 'この' . $UsID . 'は既に登録されています。';
        }

        // パスワードが一致するか確認
        if ($password !== $passCheck) {
            return 'パスワードの入力が間違っています';
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
        // データベースの更新処理を行う
        // この部分は具体的に、ユーザーのプロフィール情報を更新するSQLクエリを実行する処理を実装します
        // 例えば、UPDATE文を使用してユーザーの名前とプロフィール情報を更新する
        $sql = "UPDATE usr SET Usname = ?, Prof = ? WHERE UsId = ?";
        $this->exec($sql, [$newUserName, $newBio, $userId]);
    }
}

?>
