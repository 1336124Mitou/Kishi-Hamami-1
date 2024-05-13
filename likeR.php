<?php
// クライアントから送信された回答のIDを受け取る
$answerId = $_POST['answer_id'];

// ここでデータベースなどを使用していいねの数を増やす処理を実行する
$updatedLikes = getLikes($answerId);

// 応答を送信する
echo $updatedLikes;

// いいねの数を取得する関数の例
function getLikes($answerId) {
    // データベースに接続する
    $pdo = new PDO('mysql:host=localhost;dbname=kishi;charset=utf8', 'Kishi', 'hamami');

 // 回答のIDに基づいていいねの数を増やすUPDATE文を実行する
 $stmt = $pdo->prepare('UPDATE Reply SET LNum = LNum + 1 WHERE RepID = :answerId');
 $stmt->bindParam(':answerId', $answerId, PDO::PARAM_INT);
 $stmt->execute();

 // 更新後のいいねの数を取得する
 $stmt = $pdo->prepare('SELECT LNum FROM Reply WHERE RepID = :answerId');
 $stmt->bindParam(':answerId', $answerId, PDO::PARAM_INT);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);
 
 return $result['LNum']; // 更新後のいいねの数を返す
}

?>
