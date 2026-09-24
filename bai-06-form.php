<?php

      function validateOrder (array $data) :array {
            $errors=[];
            if(empty($data['order_code'])) {
                $errors[]='Mã đơn không được để trống';
            }
            if(empty($data['customer'])) {
                $errors[]='Tên khách không được để trống';
            }
            if(empty($data['phone'])) {
                $errors[]='Số điện thoại không được để trống';
            }
            if(empty($data['source'])) {
                $errors[]='Nguồn đơn không được để trống';
            }
            if(empty($data['product'])) {
                $errors[]='Sản phẩm không được để trống';
            }
            if(empty($data['quantity'])) {
                $errors[]='Số lượng không được để trống';
            }
            if(empty($data['price'])) {
                $errors[]='Đơn giá không được để trống';
            }
             if ($data['quantity'] <= 0) {
                $errors[] = 'Số lượng phải lớn hơn 0';
            }

            if ($data['price'] <= 0) {
                $errors[] = 'Đơn giá phải lớn hơn 0';
            }
            return $errors;
        }

        
    if ($_SERVER['REQUEST_METHOD'] ==='POST'){
        $errors = [];
$isSuccess = false;
    
        $orderCode = isset($_POST['order_code']) ? trim($_POST['order_code']) : '';
        $customer = isset($_POST['customer']) ? trim($_POST['customer']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $source = isset($_POST['source']) ? trim($_POST['source']) : '';
        $product = isset($_POST['product']) ? trim($_POST['product']) : '';
        $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : ''; 
        $price = trim($_POST['price']);

        $data = [
            'order_code' => $orderCode,
            'customer' => $customer,
            'phone' => $phone,
            'source' => $source,
            'product' => $product,
            'quantity' => $quantity,
            'price' => $price,
        ];

      
    
       $errors = validateOrder($data);
       if(!empty($errors)) {
            foreach ($errors as $error) {
                echo  $error . "<br>";
            }
       }
       else {
        echo "Tạo đơn hàng thành công";
        $isSuccess = true;
    }


       echo $orderCode . "<br>";
       echo $customer . "<br>";
       echo $phone . "<br>";
       echo $source . "<br>";
       echo $product . "<br>";
       echo $quantity . "<br>";
       echo $price . "<br>";

        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tạo đơn hàng</title>
</head>

<body>

<h2>Form tạo đơn hàng</h2>

<form method="POST">

    <label>Mã đơn:</label>
    <input type="text" name="order_code"   value="<?= !$isSuccess ? htmlspecialchars($orderCode ?? '') : '' ?>">
    <br><br>

    <label>Tên khách:</label>
    <input type="text" name="customer" value="<?= !$isSuccess ? htmlspecialchars($customer ?? '') : '' ?>">
    <br><br>

    <label>Số điện thoại:</label>
    <input type="text" name="phone"  value="<?= !$isSuccess ? htmlspecialchars($phone ?? '') : '' ?>">
    <br><br>

    <label>Nguồn đơn:</label>
    <select name="source" >
        <option value="Website">Website</option>
        <option value="Shopee Kuchen">Shopee Kuchen</option>
        <option value="Shopee Kuchen Sài Gòn">Shopee Kuchen Sài Gòn</option>
        <option value="TikTok">TikTok</option>
        <option value="Sale">Sale</option>
    </select>
    <br><br>

    <label>Sản phẩm:</label>
    <input type="text" name="product" value="<?= !$isSuccess ? htmlspecialchars($product ?? '') : '' ?>">
    <br><br>

    <label>Số lượng:</label>
    <input type="number" name="quantity" value="<?= !$isSuccess ? htmlspecialchars($quantity ?? '') : '' ?>">
    <br><br>

    <label>Đơn giá:</label>
    <input type="number" name="price" value="<?= !$isSuccess ? htmlspecialchars($price ?? '') : '' ?>">
    <br><br>

    <button type="submit">Tạo đơn hàng</button>

</form>

</body>
</html>