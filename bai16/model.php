<?php
class UserModel
{
    private PDO $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByEmail(string $email)
    {
        $sql = "SELECT * FROM users WHERE email=:email";
        $stsm = $this->pdo->prepare($sql);
        $stsm->execute([
            ':email' => $email
        ]);
        $user = $stsm->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function register(string $email, string $password)
    {
        $sql = "INSERT INTO users(email,password,role)
            VALUES(:email,:password,:role)";
        $stsm = $this->pdo->prepare($sql);
        $stsm->execute([
            ':email' => $email,
            ':password' => $password,
            ':role' => 'user'
        ]);

        return $this->pdo->lastInsertId();
    }
}
