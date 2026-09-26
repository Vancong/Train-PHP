<?php
class OrderService
{
    public function calculateTotal(array $items): float
    {
        $total = 0;
        foreach ($items as $item) {
            $total += ($item['price'] * $item['quantity']);
        }
        return $total;
    }
    public function checkDuplicate(string $orderCode, array $existingOrders): bool
    {
        foreach ($existingOrders as $order) {
            if ($order['order_code'] == $orderCode) {
                return true;
            }
        }
        return false;
    }
    public function getStatus(string $statusCode): string
    {
        $statusMap = [
            'pending' => 'Cho xy ly',
            'processing' => 'Dang chuan bi hang',
            'shipped' => 'Da giao',
            'cancel' => 'Da huy',
            'complete' => 'Hoan thanh'
        ];
        return $statusMap[$statusCode] ?? 'Khong xac dinh';
    }
}
