<?php
class OrderModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getOrders()
    {
        $sql = "SELECT * FROM orders";
        $result = $this->db->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    public function getOrderById($orderId)
    {
        $sql = "SELECT * FROM orders WHERE id = :orderId";
        $stsm = $this->db->prepare($sql);
        $stsm->execute([
            "orderId" => $orderId
        ]);
        return $stsm->fetch(PDO::FETCH_ASSOC) ?? [];
    }

    public function getOrderByOrderCode($orderCode)
    {
        $sql = "SELECT * FROM orders WHERE order_code = :orderCode";
        $stsm = $this->db->prepare($sql);
        $stsm->execute([
            "orderCode" => $orderCode
        ]);
        return $stsm->fetch(PDO::FETCH_ASSOC) ?? [];
    }

    public function getProductOfOrder($orderId)
    {
        $sql = "SELECT o.order_code, o.customer_name, 
                o.phone, op.quantity,op.price,p.name ,o.status,o.source 
                 FROM orders o
                 JOIN order_products op 
                 ON o.id = op.order_id 
                 JOIN products p
                 ON op.product_id = p.id
                WHERE o.id=:orderId";
        $stsm = $this->db->prepare($sql);
        $stsm->execute([
            "orderId" => $orderId
        ]);
        return $stsm->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    public function createOrder($data)
    {
        $sql = "INSERT INTO orders (order_code, customer_name, phone, source, status) 
                VALUES (:order_code, :customer_name, :phone, :source, :status)";
        $stsm = $this->db->prepare($sql);

        $stsm->execute([
            "order_code" => $data['order_code'],
            "customer_name" => $data['customer_name'],
            "phone" => $data['phone'],
            "source" => $data['source'],
            "status" => $data['status'],
        ]);
        return $stsm->fetch(PDO::FETCH_ASSOC) ?? [];
    }

    public function updateOrder($orderId, $data)
    {
        $sql = "UPDATE orders SET order_code = :order_code,  customer_name = :customer_name, 
                phone = :phone, source = :source, status = :status 
                WHERE id = :orderId";
        $stsm = $this->db->prepare($sql);

        $stsm->execute([
            "order_code" => $data['order_code'],
            "customer_name" => $data['customer_name'],
            "phone" => $data['phone'],
            "source" => $data['source'],
            "status" => $data['status'],
            "orderId" => $orderId
        ]);
        return $stsm->fetch(PDO::FETCH_ASSOC) ?? [];
    }

    public function deleteOrder($orderId)
    {
        $sql1 = "DELETE FROM order_products WHERE order_id=:orderId";
        $stsm1 = $this->db->prepare($sql1);
        $stsm1->execute([
            "orderId" => $orderId
        ]);

        $sql2 = "DELETE FROM orders WHERE id=:orderId";
        $stsm2 = $this->db->prepare($sql2);
        $stsm2->execute([
            "orderId" => $orderId
        ]);
        return true;
    }
}
