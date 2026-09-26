<?php
require_once './product.php';
require_once './customer.php';
require_once './order.php';
$product = new Product('Máy lọc nước', 10000000, 1);
$product1 = new Product(
    "Máy lọc nước",
    13500000,
    5
);
$customer = new Customer('Tran Van cong', '020393232');
$order = new Order('1', $customer);
$order->addProduct($product);
$order->addProduct($product1);
echo $customer->getName() . "\n";
echo $customer->getPhone() . "\n";
foreach ($order->getProducts() as $item) {
    echo $item->getName() . "\n";
    echo $item->getPrice() . "\n";
    echo $item->getQuantity() . "\n";
}
echo $order->getTotal();
