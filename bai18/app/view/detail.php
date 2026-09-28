<?php


/** @var array $order */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
</head>

<body>

    <h1>Chi tiết đơn hàng <?php echo $order['info']['order_code']; ?></h1>
    <p>Mã đơn hàng: <?php echo $order['info']['order_code']; ?></p>
    <p>Khách hàng: <?php echo $order['info']['customer_name']; ?></p>
    <p>Số điện thoại: <?php echo $order['info']['phone']; ?></p>
    <p>Nguồn: <?php echo $order['info']['source']; ?></p>
    <p>Trạng thái: <?php echo $order['info']['status']; ?></p>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order['items'] as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($item['price'], 0, ',', '.') . "đ"; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>Tổng tiền: <?php echo number_format($order['total'], 0, ',', '.') . "đ"; ?></p>
    <a href="/bai18/orders">Quay lại danh sách đơn hàng</a>
</body>

</html>