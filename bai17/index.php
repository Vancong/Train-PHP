<?php

require_once 'config.php';
require_once 'model.php';

$model = new OrderModel($pdo);

$id = $_GET['id'] ?? '';

if (!filter_var($id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]))
    die("ID không hợp lệ");

$order = $model->getOrderById($id);

if ($order) {

    $order['customer_name'] = "<script>alert('Website của bạn đã bị hack, toàn bộ Cookie đã bị đánh cắp!')</script>";

    echo "<h2>Thông tin đơn hàng</h2>";
    echo "<p>Mã đơn: " . $order['order_code'] . "</p>";


    echo "<p>Tên khách: " . htmlspecialchars($order['customer_name']) . "</p>";
}
