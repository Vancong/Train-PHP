<?php 
    $orderCode = '260924ABC123';
    $productName = 'Máy lọc nước KUCHEN';
    $quantity = 2;
    $price = 7500000;
    $discount = 500000;
    $shippingFee = 30000;

    $totalProduct= $quantity * $price;

    $finalTotal = $totalProduct - $discount + $shippingFee;

    echo "Tổng tiền: " . number_format($finalTotal) . " VNĐ";

?>