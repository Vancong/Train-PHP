<?php

require_once "../config.php";
require_once "./validate.php";
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
$stsm->execute([
    'id' => $id
]);
$order = $stsm->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo 'Không tìm thấy đơn hàng';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $errors = validateOrder($data);
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit;
    }
    $sql = "UPDATE orders SET 
                 order_code = :order_code,
                customer_name = :customer_name,
                phone = :phone,
                source = :source,
                total = :total,
                status = :status
            WHERE id = :id ";

    $stsm = $pdo->prepare($sql);
    $stsm->execute([
        'order_code' => $data['order_code'],
        'customer_name' => $data['customer_name'],
        'phone' => $data['phone'],
        'source' => $data['source'],
        'total' => $data['total'],
        'status' => $data['status'],
        'id' => $id
    ]);
    header('Location: /index.php');
    exit;
}




?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa đơn hàng</title>
</head>

<body>

    <h1>Sửa đơn hàng</h1>

    <form method="POST">

        <div>
            <label>Mã đơn hàng:</label>
            <input
                type="text"
                name="order_code"
                value="<?= $order['order_code'] ?>">
        </div>

        <br>

        <div>
            <label>Khách hàng:</label>
            <input
                type="text"
                name="customer_name"
                value="<?= $order['customer_name'] ?>">
        </div>

        <br>

        <div>
            <label>Số điện thoại:</label>
            <input
                type="text"
                name="phone"
                value="<?= $order['phone'] ?>">
        </div>

        <br>
        <div>
            <label>Nguồn:</label>

            <select name="source">
                <option value="Website"
                    <?= $order['source'] === 'Website' ? 'selected' : '' ?>>
                    Website
                </option>

                <option value="Shopee Kuchen"
                    <?= $order['source'] === 'Shopee Kuchen' ? 'selected' : '' ?>>
                    Shopee Kuchen
                </option>

                <option value="Shopee Kuchen Sài Gòn"
                    <?= $order['source'] === 'Shopee Kuchen Sài Gòn' ? 'selected' : '' ?>>
                    Shopee Kuchen Sài Gòn
                </option>

                <option value="TikTok"
                    <?= $order['source'] === 'TikTok' ? 'selected' : '' ?>>
                    TikTok
                </option>

                <option value="Sale"
                    <?= $order['source'] === 'Sale' ? 'selected' : '' ?>>
                    Sale
                </option>
            </select>
        </div>

        <br>

        <div>
            <label>Tổng tiền:</label>
            <input
                type="number"
                name="total"
                value="<?= $order['total'] ?>">
        </div>

        <br>

        <div>
            <label>Trạng thái:</label>
            <input
                type="text"
                name="status"
                value="<?= $order['status'] ?>">
        </div>

        <br>

        <button type="submit">Cập nhật đơn hàng</button>

    </form>

</body>

</html>