<?php
require_once './order.service.php';

$service = new OrderService();

$existingOrders = [
    [
        'order_code' => 'DH001'
    ],
    [
        'order_code' => 'DH002'
    ]
];

$items = [
    [
        'price' => 50,
        'quantity' => 1
    ],
    [
        'price' => 12,
        'quantity' => 2
    ]
];

$total = $service->calculateTotal($items);
echo $total . "\n";

$isDuplicate = $service->checkDuplicate('DH00123', $existingOrders);
var_dump($isDuplicate);
echo $isDuplicate ? "Đơn hàng bị trùng" : "Đơn hàng không bị trùng \n";

echo $service->getStatus('pending') . "\n";
echo $service->getStatus('shipped') . "\n";
echo $service->getStatus('abc') . "\n";
