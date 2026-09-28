<?php
require_once __DIR__ . '/../helper/validateOrder.php';

class OrderService
{
    private $orderModel;

    public function __construct($orderModel)
    {
        $this->orderModel = $orderModel;
    }

    public function getOrders()
    {
        return $this->orderModel->getOrders();
    }

    public function getOrderById($orderId)
    {
        $data = $this->orderModel->getOrderById($orderId);
        if ($data === null) {
            throw new Exception("Không tồn tại đơn hàng");
        }
        return $data;
    }

    public function getProductOfOrder($orderId)
    {
        return $this->orderModel->getProductOfOrder($orderId);
    }


    public function getOrderDetail($orderId)
    {
        $info = $this->orderModel->getOrderById($orderId);

        if (!$info) {
            return false;
        }

        $items = $this->getProductOfOrder($orderId);

        $total = 0;

        foreach ($items as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        return [
            "info" => $info,
            'items' => $items,
            'total' => $total
        ];
    }

    public function create($data)
    {


        $errors = validateOrder($data);

        $checkDuplicate = $this->orderModel->getOrderByOrderCode($data['order_code']);
        if (!empty($checkDuplicate)) {
            $errors[] = 'Đã tồn tại mã đơn hàng này';
        }
        if (!empty($errors)) {
            return $errors;
        }
        return $this->orderModel->createOrder($data);
    }

    public function update($orderId, $data)
    {
        $errors = validateOrder($data);
        if (!empty($errors)) {
            return $errors;
        }
        return $this->orderModel->updateOrder($orderId, $data);
    }

    public function delete($orderId)
    {
        if ($this->orderModel->getOrderById($orderId) === null) {
            throw new Exception("Không tồn tại đơn hàng");
        }
        return $this->orderModel->deleteOrder($orderId);
    }
}
