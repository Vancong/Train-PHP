<?php
require_once 'customer.php';
require_once 'product.php';
class Order
{
    private string $orderCode;
    private Customer $customer;
    private array $products = [];

    public function __construct($orderCode, $customer)
    {
        $this->orderCode = $orderCode;
        $this->customer = $customer;
    }



    public function addProduct(Product $products)
    {
        $this->products[] = $products;
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice() * $product->getQuantity();
        }
        return $total;
    }
    public function getOrderCode()
    {
        return $this->orderCode;
    }
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}
