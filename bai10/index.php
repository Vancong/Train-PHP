<?php
require_once "./config.php";
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
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

$sql = "SELECT * FROM orders";
$stsm = $pdo->prepare($sql);
$stsm->execute();
$orders = $stsm->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
</head>

<body>
    <h2>Danh sách đơn hàng</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã đơn</th>
                <th>Mã vận đơn</th>
                <th>Mã đơn Shopee</th>
                <th>Khách hàng</th>
                <th>SĐT</th>
                <th>Nguồn</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['order_code'] ?></td>
                    <td><?= $order['tracking_code'] ?></td>
                    <td><?= $order['shopee_order_code'] ?></td>
                    <td><?= $order['customer_name'] ?></td>
                    <td><?= $order['phone'] ?></td>
                    <td><?= $order['source'] ?></td>
                    <td><?= $order['total'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td><?= $order['created_at'] ?></td>
                    <td>
                        <a href="create.php">Thêm đơn</a> |
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>