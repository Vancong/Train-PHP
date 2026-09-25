<?php
require_once './config.php';
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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderCode = $_POST['order_code'];
    $trackingOrder = $_POST['tracking_code'];
    $shopeeOrderCode = $_POST['shopee_order_code'];
    $customerName = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $source = $_POST['source'];
    $status = $_POST['status'];
    $total = $_POST['total'];

    foreach ($orders as $order) {
        if ($order['order_code'] == $orderCode) {
            die("Mã đơn hàng đã tồn tại");
        }
        if ($order['tracking_code'] == $trackingOrder) {
            die("Mã vận đơn đã tồn tại");
        }
        if ($order['shopee_order_code'] == $shopeeOrderCode) {
            die("Mã đơn Shopee đã tồn tại");
        }
    }

    $sql = "INSERT INTO orders
         (
            order_code,
            tracking_code,
            shopee_order_code,
            customer_name,
            phone,
            source,
            status,
            total
         )VALUES (:order_code,:tracking_code,:shopee_order_code,:customer_name,:phone,:source,:status,:total)";
    $stsm = $pdo->prepare($sql);
    $stsm->execute([
        'order_code' => $orderCode,
        'tracking_code' => $trackingOrder,
        'shopee_order_code' => $shopeeOrderCode,
        'customer_name' => $customerName,
        'phone' => $phone,
        'source' => $source,
        'status' => $status,
        'total' => $total
    ]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm đơn hàng</title>
</head>

<body>
    <h2>Thêm đơn hàng</h2>
    <form action="create.php" method="POST">
        <label for="order_code">Mã đơn hàng:</label>
        <input type="text" id="order_code" name="order_code"><br><br>

        <label for="tracking_code">Ma van don: </label>
        <input type="text" id="tracking_code" name="tracking_code"><br><br>

        <label for="shopee_order_code">Ma don Shopee: </label>
        <input type="text" id="shopee_order_code" name="shopee_order_code"><br><br>

        <label for="customer_name">Tên khách hàng:</label>
        <input type="text" id="customer_name" name="customer_name"><br><br>

        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="source">Nguồn:</label>
        <select id="source" name="source">
            <option value="Website">Website</option>
            <option value="Shopee">Shopee</option>
            <option value="Tiktok">Tiktok</option>
        </select><br><br>

        <label for="status">Trạng thái:</label>
        <input type="text" id="status" name="status"><br><br>

        <label for="total">Tổng tiền:</label>
        <input type="text" id="total" name="total"><br><br>

        <input type="submit" value="Thêm đơn hàng">
    </form>
</body>

</html>