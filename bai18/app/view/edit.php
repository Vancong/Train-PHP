<?php

/** @var array $order */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Sửa đơn hàng <?php echo $order['info']['order_code']; ?></h1>
    <form action="?action=update&id=<?php echo $order['info']['id']; ?>" method="post">
        <label for="customer_name">Tên khách hàng</label> <br>
        <input type="text" name="customer_name" id="customer_name"
            value="<?php echo $order['info']['customer_name']; ?>"><br>
        <label for="phone">Số điện thoại</label><br>
        <input type="text" name="phone" id="phone" value="<?php echo $order['info']['phone']; ?>"><br>
        <label for="source">Nguồn</label><br>
        <input type="text" name="source" id="source" value="<?php echo $order['info']['source']; ?>"><br>
        <label for="status">Trạng thái</label><br>
        <input type="text" name="status" id="status" value="<?php echo $order['info']['status']; ?>"><br>
        <input type="text" name="order_code" id="order_code" value="<?php echo $order['info']['order_code']; ?>"><br>
        <button type="submit">Sửa đơn hàng</button>

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
    <a href="/bai18/orders">Quay lại danh sách đơn hàng</a>
</body>

</html>