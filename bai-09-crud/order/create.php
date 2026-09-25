<?php

require_once '../config.php';
require_once './validate.php';
$dsn = "mysql:host=$localhost;dbname=$dbname;charset=utf8mb4";
$isSuccess = false;
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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $orderCode = $_POST['order_code'] ?? '';
    $customerName = $_POST['customer_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $source = $_POST['source'] ?? '';
    $total = $_POST['total'] ?? '';
    $status = $_POST['status'] ?? '';

    $data = $_POST;
    $errors = validateOrder($data);
    if (empty($errors)) {
        $sql = "INSERT INTO orders (
              order_code,customer_name,phone,source,total,status
            )
              VALUES
              (:order_code,:customer_name,:phone,:source,:total,:status)";
        $stsm = $pdo->prepare($sql);
        $stsm->execute(
            [
                'order_code' => $orderCode,
                'customer_name' => $customerName,
                'phone' => $phone,
                'source' => $source,
                'total' => $total,
                'status' => $status
            ]
        );
        $isSuccess = true;
        header("Location: index.php");
        exit;
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
    echo "<pre>";
    print_r($errors);
    echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm đơn hàng</title>
</head>

<body>

    <h1>Thêm đơn hàng</h1>

    <form method="POST">

        <div>
            <label>Mã đơn hàng:</label>
            <input type="text" name="order_code">
        </div>
        <br />
        <div>
            <label>Khách hàng:</label>
            <input type="text" name="customer_name">
        </div>
        <br />
        <div>
            <label>Số điện thoại:</label>
            <input type="text" name="phone">
        </div>
        <br />
        <label>Nguồn đơn:</label>
        <select name="source">
            <option value="Website">Website</option>
            <option value="Shopee Kuchen">Shopee Kuchen</option>
            <option value="Shopee Kuchen Sài Gòn">Shopee Kuchen Sài Gòn</option>
            <option value="TikTok">TikTok</option>
            <option value="Sale">Sale</option>
        </select>
        <br />
        <div>
            <label>Tổng tiền:</label>
            <input type="number" name="total">
        </div>
        <br />

        <div>
            <label>Trạng thái:</label>
            <input type="text" name="status">
        </div>
        <br />

        <button type="submit">Thêm đơn</button>

        <?php if ($isSuccess): ?>
            <p style="color: green;">Thêm đơn hàng thành công!</p>
        <?php endif; ?>
    </form>

</body>

</html>