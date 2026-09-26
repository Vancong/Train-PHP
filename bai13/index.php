<?php
require_once './controller.php';
/** @var array $orders */

?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
</head>

<body>
    <h1>Danh sách đơn hàng</h1>
    <?php foreach ($orders as $order): ?>
        <h2> Đơn hàng #<?= $order['order_code'] ?> </h2>
        <p> Tên khách hàng: <?= $order['customer_name'] ?> </p>
        <p> Số điện thoại: <?= $order['phone'] ?> </p>
        <?php foreach ($order['items'] as $item): ?>
            <p> Tên sản phẩm: <?= $item['name'] ?> </p>
            <p> Số lượng: <?= $item['quantity'] ?> </p>
            <p> Giá: <?= number_format($item['price']) ?> VND </p>
        <?php endforeach ?>
        <p> Tổng tiền: <?= number_format($order['total']) ?> VND </p>
        <p> Trạng thái: <?= $order['status'] ?> </p>
    <?php endforeach ?>
</body>

</html>