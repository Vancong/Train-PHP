<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Thêm đơn hàng</h1>

    <form action="?action=store" method="post">

        <label for="customer_name">Tên khách hàng</label> <br>
        <input type="text" name="customer_name" id="customer_name" value="<?php echo $order['customer_name'] ?? '' ?>"> <br>

        <label for="phone">Số điện thoại</label> <br>
        <input type="text" name="phone" id="phone" value="<?php echo $order['phone'] ?? '' ?>"> <br>

        <label for="source">Nguồn</label> <br>
        <input type="text" name="source" id="source" value="<?php echo $order['source'] ?? '' ?>"> <br>

        <label for="status">Trạng thái</label> <br>
        <input type="text" name="status" id="status" value="<?php echo $order['status'] ?? '' ?>"> <br>

        <label for="order_code">Mã đơn hàng</label> <br>
        <input type="text" name="order_code" id="order_code" value="<?php echo $order['order_code'] ?? '' ?>"> <br>

        <button type="submit">Thêm đơn hàng</button>
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li style="color: red;">
                        <?php echo $error; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </form>
</body>

</html>