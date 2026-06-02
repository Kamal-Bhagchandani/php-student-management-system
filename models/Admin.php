<?php
class Admin
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function verifyCredentials(string $username, string $password): ?array
    {
        $stmt = $this->conn->prepare('SELECT * FROM admins WHERE username = :username LIMIT 1');
        $stmt->execute([':username' => $username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }

        return null;
    }
}
