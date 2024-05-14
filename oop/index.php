
<?php 

require 'oop/vendor/autoload.php';

use WarehouseApp\Product;
use WarehouseApp\Warehouse;
use WarehouseApp\Logistics;



echo '<pre>';
$warehouseKiev = new Warehouse("Киев");
$warehouseZhmerenke = new Warehouse("Жмеринка");

$product1 = new Product("Мука", 10, 100);
$product2 = new Product("Цемент", 25, 50);
$product3 = new Product("Сахар", 15, 200);

$warehouseKiev->registerProduct($product1);
$warehouseKiev->registerProduct($product2);
$warehouseKiev->registerProduct($product3);

$warehouseKiev->writeOffProduct("Сахар", 50);
$warehouseKiev->getStockReport();

$warehouseKiev->burnAllProducts();
$warehouseKiev->getStockReport(); 

$warehouseKiev->registerProduct($product1);
$warehouseKiev->registerProduct($product3);
Logistics::transferProductsBetweenWarehouses($warehouseKiev, $warehouseZhmerenke);
$warehouseZhmerenke->getStockReport(); 