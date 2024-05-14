<?php 
namespace WarehouseApp;
class Logistics {
    public static function transferProductsBetweenWarehouses(Warehouse $sourceWarehouse, Warehouse $targetWarehouse) {
        $sourceWarehouse->transferAllProducts($targetWarehouse);
    }
}