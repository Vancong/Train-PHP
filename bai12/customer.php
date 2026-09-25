<?php
class Customer
{
    private string $name;
    private string $phone;

    public function __construct($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPhone()
    {
        return $this->phone;
    }
}
