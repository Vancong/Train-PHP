<?php
require_once '../config.php';
$dsn = "mysql:host=$localhost;dbname=$dbname;charset=utf8mb4";
$orderCode = $_GET['order_code'] ?? '';
$source = $_GET['source'] ?? '';
try {
    $pdo = new PDO(
        $dsn,
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
    $sql = "SELECT * FROM orders
            WHERE order_code LIKE :order_code";

    $params = [
        'order_code' => "%$orderCode%"
    ];

    if ($source !== '') {
        $sql .= " AND source = :source";
        $params['source'] = $source;
    }

    $stsm = $pdo->prepare($sql);
    $stsm->execute($params);
    $orders = $stsm->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}




?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn hàng</title>
</head>

<body>

    <h1>Danh sách đơn hàng</h1>
    <form method="GET">
        <input
            type="text"
            name="order_code"
            placeholder="Nhập mã đơn hàng"
            value="<?= $_GET['order_code'] ?? '' ?>">

        <select name="source">
            <option value="">-- Tất cả nguồn --</option>

            <option value="Website"
                <?= ($_GET['source'] ?? '') === 'Website' ? 'selected' : '' ?>>
                Website
            </option>

            <option value="Shopee Kuchen"
                <?= ($_GET['source'] ?? '') === 'Shopee Kuchen' ? 'selected' : '' ?>>
                Shopee Kuchen
            </option>

            <option value="Shopee Kuchen Sài Gòn"
                <?= ($_GET['source'] ?? '') === 'Shopee Kuchen Sài Gòn' ? 'selected' : '' ?>>
                Shopee Kuchen Sài Gòn
            </option>

            <option value="TikTok"
                <?= ($_GET['source'] ?? '') === 'TikTok' ? 'selected' : '' ?>>
                TikTok
            </option>

            <option value="Sale"
                <?= ($_GET['source'] ?? '') === 'Sale' ? 'selected' : '' ?>>
                Sale
            </option>
        </select>
        <button type="submit">Tìm kiếm</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Mã đơn</th>
            <th>Khách hàng</th>
            <th>SĐT</th>
            <th>Nguồn</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
        </tr>

        <?php foreach ($orders as $order): ?>

            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['order_code'] ?></td>
                <td><?= $order['customer_name'] ?></td>
                <td><?= $order['phone'] ?></td>
                <td><?= $order['source'] ?></td>
                <td><?= $order['total'] ?></td>
                <td><?= $order['status'] ?></td>
                <td><?= $order['created_at'] ?></td>
                <td>
                    <a href="show.php?id=<?= $order['id'] ?>">Xem</a>

                    <a href="edit.php?id=<?= $order['id'] ?>">Sửa</a>

                    <a
                        href="delete.php?id=<?= $order['id'] ?>"
                        onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')">
                        Xóa
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>