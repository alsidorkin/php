<?php 
namespace WarehouseApp;
class Warehouse {
    private $location;
    private $products = [];

    public function __construct($location) {
        $this->location = $location;
    }

    public function registerProduct(Product $product) {
        if ($product->weight > 20) {
            echo "Продукт {$product->name} не может быть зарегистрирован, так как его вес превышает 20кг.\n";
            return false;
        }
        $this->products[] = $product;
        echo "Продукт {$product->name} зарегистрирован на складе.\n";
        return true;
    }

    public function writeOffProduct($productName, $quantity) {
        foreach ($this->products as $index => $product) {
            if ($product->name == $productName) {
                if ($product->quantity >= $quantity) {
                    $product->quantity -= $quantity;
                    echo "Списано $quantity единиц продукта $productName.\n";
                    if ($product->quantity == 0) {
                        unset($this->products[$index]);
                        echo "Продукт $productName полностью списан со склада.\n";
                    }
                    return true;
                } else {
                    echo "Недостаточно товара $productName для списания.\n";
                    return false;
                }
            }
        }
        echo "Продукт $productName не найден на складе.\n";
        return false;
    }

    public function getStockReport() {
        echo "Отчет об остатках на складе {$this->location}:\n";
        foreach ($this->products as $product) {
            echo "Продукт: {$product->name}, Количество: {$product->quantity}, Вес: {$product->weight} кг\n";
        }
    }

    public function burnAllProducts() {
        $this->products = [];
        echo "Все товары на складе {$this->location} уничтожены.\n";
    }

    public function transferAllProducts(Warehouse $targetWarehouse) {
        foreach ($this->products as $product) {
            if ($targetWarehouse->registerProduct($product)) {
                echo "Продукт {$product->name} перенесен в склад {$targetWarehouse->getLocation()}.\n";
            }
        }
        $this->products = [];
    }

    public function getLocation() {
        return $this->location;
    }
}
