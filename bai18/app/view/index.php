<?php

/** @var array $orders */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Danh sách đơn hàng</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Nguồn</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['order_code']; ?></td>
                    <td><?php echo $order['customer_name']; ?></td>
                    <td><?php echo $order['phone']; ?></td>
                    <td><?php echo $order['source']; ?></td>

                    <td><?php echo $order['status']; ?></td> <br />
                    <td><a href="orders/<?php echo $order['id']; ?>">Xem chi tiết</a></td>
                    <td><a href="orders/edit/<?php echo $order['id']; ?>">Sửa</a></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')"
                            href="orders/delete/<?php echo $order['id']; ?>">Xóa</a></td>
                </tr>
            <?php endforeach; ?>

        </tbody>

    </table>
    <a href="orders/create">Thêm đơn hàng</a>
</body>

</html>