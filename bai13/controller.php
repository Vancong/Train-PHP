<?php

require_once './config.php';
require_once './model.php';
require_once './order.service.php';

$model = new OrderModel($pdo);
$service = new OrderService();
$orders = $model->getOrder();

foreach ($orders as &$order) {
    $items = $model->getOrderProducts($order['id']);
    $order['items'] = $items;

    $order['total'] = $service->calculateTotal($order['items']);
    $order['status'] = $service->getStatus($order['status']);
}

unset($order);
