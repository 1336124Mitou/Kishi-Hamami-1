<?php
class User {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=kishi', 'Kishi', 'hamami');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function myProfile($userId) {
        $stmt = $this->pdo->prepare('SELECT UsID, UsName, Prof FROM Usr WHERE UsID = :userId');
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($userId, $userName, $prof) {
        $stmt = $this->pdo->prepare('UPDATE Usr SET UsName = :userName, Prof = :prof WHERE UsID = :userId');
        return $stmt->execute(['userName' => $userName, 'prof' => $prof, 'userId' => $userId]);
    }
}
?>
