<?php

class OrderController
{
    private $orderService;

    public function __construct($pdo)
    {
        $orderModel = new OrderModel($pdo);
        $this->orderService = new OrderService($orderModel);
    }

    public function index()
    {
        $orders = $this->orderService->getOrders();
        require_once __DIR__ . '/../view/index.php';
    }

    public function detail($orderId)
    {
        $order = $this->orderService->getOrderDetail($orderId);
        if (!$order) {
            die("Không tồn tại đơn hàng");
        }
        require_once __DIR__ . '/../view/detail.php';
    }

    public function showCreateForm()
    {
        require_once __DIR__ . '/../view/create.php';
    }

    public function create($data)
    {
        $errors = $this->orderService->create($data);
        if (!empty($errors)) {
            $order = $data;
            require_once __DIR__ . '/../view/create.php';
            return;
        }
        header("Location: /bai18/orders");
    }

    public function showEditForm($orderId)
    {
        $order = $this->orderService->getOrderDetail($orderId);
        require_once __DIR__ . '/../view/edit.php';
    }

    public function update($orderId, $data)
    {
        $errors = $this->orderService->update($orderId, $data);
        if (!empty($errors)) {
            $order = $this->orderService->getOrderDetail($orderId);
            $order['info'] = array_merge($order['info'], $data);
            require_once __DIR__ . '/../view/edit.php';
            return;
        }
        header("Location: /bai18/orders");
    }

    public function delete($orderId)
    {
        $order = $this->orderService->getOrderById($orderId);
        if (!$order) {
            die("Không tồn tại đơn hàng");
        }
        $this->orderService->delete($orderId);
        header("Location: /bai18/orders");
    }
}
