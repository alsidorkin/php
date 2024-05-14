<?php  
namespace WarehouseApp;
class Product {
    public $name;
    public $weight;
    public $quantity;

    public function __construct($name, $weight, $quantity) {
        $this->name = $name;
        $this->weight = $weight;
        $this->quantity = $quantity;
    }
}