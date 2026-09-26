<?php

class OrderModel
{
    private PDO $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getOrder(): array
    {
        $sql = "
            SELECT * FROM orders;
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderProducts(int $orderId): array
    {
        $sql = "SELECT o.id,o.order_code,o.customer_name,o.phone,o.status,op.product_id,
             op.quantity,op.price, p.name,p.sku FROM orders o 
             JOIN order_products op
             ON o.id=op.order_id
             JOIN products p
             ON op.product_id=p.id
             WHERE o.id=:orderId";
        $stsm = $this->pdo->prepare($sql);
        $stsm->execute([
            ':orderId' => $orderId
        ]);
        return $stsm->fetchAll(PDO::FETCH_ASSOC);
    }
}
