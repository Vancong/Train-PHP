<?php


require_once "../config.php";
$dsn = "mysql:host=$localhost;dbname=$dbname;charset=utf8mb4";

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
    die('Kết nối thất bại:' . $e->getMessage());
}

$id = $_GET['id'];


if (!$id) {
    die("Thiếu ID đơn hàng");
}

if (!is_numeric($id)) {
    die("ID đơn hàng không hợp lệ");
}

$sql = "SELECT * FROM orders WHERE id=:id";
$stsm = $pdo->prepare($sql);
$stsm->execute([
    'id' => $id
]);
$order = $stsm->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo 'Không tìm thấy đơn hàng';
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
</head>

<body>

    <h1>Chi tiết đơn hàng</h1>

    <p><strong>ID:</strong> <?= $order['id'] ?></p>
    <p><strong>Mã đơn:</strong> <?= $order['order_code'] ?></p>
    <p><strong>Khách hàng:</strong> <?= $order['customer_name'] ?></p>
    <p><strong>SĐT:</strong> <?= $order['phone'] ?></p>
    <p><strong>Nguồn:</strong> <?= $order['source'] ?></p>
    <p><strong>Tổng tiền:</strong> <?= $order['total'] ?></p>
    <p><strong>Trạng thái:</strong> <?= $order['status'] ?></p>
    <p><strong>Ngày tạo:</strong> <?= $order['created_at'] ?></p>

</body>

</html>