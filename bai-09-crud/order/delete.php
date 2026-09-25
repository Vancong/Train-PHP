<?php

require_once '../config.php';

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
    echo "kết nối thành công";
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Thiếu ID đơn hàng");
}
if (!is_numeric($id)) {
    die("ID đơn hàng không hợp lệ");
}

$sql = "SELECT * FROM orders WHERE id=:id";
$stsm = $pdo->prepare($sql);
$stsm->execute(
    [
        'id' => $id
    ]
);

$order = $stsm->fetch(PDO::FETCH_ASSOC);
if (!$order) {
    echo "không tìm thấy đơn hàng";
    exit;
}


$sql = "DELETE FROM orders WHERE id=:id";
$stsm = $pdo->prepare($sql);
$stsm->execute(
    [
        'id' => $id
    ]
);

header("Location: /index.php");
exit;
