<?php
require_once "./config.php";
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO(
        dsn: $dsn,
        username: $username,
        password: $password,
        options: [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
    echo "kết nối thành công";
} catch (PDOException $e) {
    die("kết nối thất bại: " . $e->getMessage());
}

$sql = "SELECT 
   o.order_code,
   o.customer_name,
   p.sku,
   p.name,
   op.quantity,
   op.price,
   op.quantity * op.price AS subtotal
   FROM orders o
   JOIN order_products op
   ON o.id = op.order_id
   JOIN products p
   ON p.id = op.product_id
";
$stsm = $pdo->prepare($sql);
$stsm->execute();
$orders = $stsm->fetchAll(PDO::FETCH_ASSOC);

$sqlReport = "
    SELECT
        o.source,
        SUM(op.quantity * op.price) AS revenue,
        COUNT(DISTINCT o.id) AS total_order
    FROM orders o
    JOIN order_products op
        ON o.id = op.order_id
    GROUP BY o.source
";

$stmtReport = $pdo->prepare($sqlReport);
$stmtReport->execute();
$reports = $stmtReport->fetchAll(PDO::FETCH_ASSOC);
$sqlTopProduct = "SELECT p.sku,p.name, SUM(op.quantity) AS total_quantity
                 FROM products p
                 JOIN order_products op
                 ON p.id=op.product_id
                 GROUP BY p.sku,p.name
                 ORDER BY SUM(op.quantity) DESC
                 LIMIT 5";
$stmtTopProduct = $pdo->prepare($sqlTopProduct);
$stmtTopProduct->execute();
$topProducts = $stmtTopProduct->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Doanh thu theo kênh bán hàng,Tổng số đơn hàng</h1>

    <table border="1">
        <tr>
            <th>Nguồn</th>
            <th>Doanh thu</th>
            <th>Tổng số đơn hàng</th>
        </tr>
        <?php foreach ($reports as $report): ?>
            <tr>
                <td><?php echo $report['source']; ?></td>
                <td><?php echo number_format($report['revenue']); ?> VNĐ</td>
                <td><?php echo $report['total_order']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h1>Top 5 sản phẩm bán chạy nhất</h1>
    <table border="1">
        <tr>
            <th>SKU</th>
            <th>Tên sản phẩm</th>
            <th>Tổng số lượng</th>
        </tr>
        <?php foreach ($topProducts as $topProduct): ?>
            <tr>
                <td><?php echo $topProduct['sku']; ?></td>
                <td><?php echo $topProduct['name']; ?></td>
                <td><?php echo $topProduct['total_quantity']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>




    <h1>Đơn hàng</h1>

    <table border="1">
        <tr>
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>SKU</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thành tiền</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['order_code']; ?></td>
                <td><?php echo $order['customer_name']; ?></td>
                <td><?php echo $order['sku']; ?></td>
                <td><?php echo $order['name']; ?></td>
                <td><?php echo $order['quantity']; ?></td>
                <td><?php echo number_format($order['price']); ?> VNĐ</td>
                <td><?php echo number_format($order['subtotal']); ?> VNĐ</td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>