<?php
require_once 'config.php';


$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO(
        $dsn,
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
    echo "Kết nối thành công";
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
