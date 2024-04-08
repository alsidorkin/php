<?php
require_once 'functions.php';

// створити продукт
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_product'])) {

  $productName = isset($_POST['productName']) ? $_POST['productName'] : '';
  $productLine = isset($_POST['productLine']) ? $_POST['productLine'] : '';
  $productCode = isset($_POST['productCode']) ? $_POST['productCode'] : '';
  $productScale = isset($_POST['productScale']) ? $_POST['productScale'] : '';
  $productVendor = isset($_POST['productVendor']) ? $_POST['productVendor'] : '';
  $productDescription = isset($_POST['productDescription']) ? $_POST['productDescription'] : '';
  $quantityInStock = isset($_POST['quantityInStock']) ? $_POST['quantityInStock'] : '';
  $buyPrice = isset($_POST['buyPrice']) ? $_POST['buyPrice'] : '';
  $MSRP = isset($_POST['MSRP']) ? $_POST['MSRP'] : '';

  if (
    $productName === '' || $productLine === '' || $productCode === '' || $productScale === ''
    || $productVendor === '' || $productDescription === '' || $quantityInStock === '' || $buyPrice === ''
    || $MSRP === ''
  ) {
    echo "Не все поля заполнены!!!";
    exit();
  } else {
    $existance = readOne($productCode);

    if ($existance && $existance['productCode'] === $productCode) {
      echo "Продукт с такими данными уже существует!!!";
      exit();
    } else {

      $data = [
        'productCode' => $productCode,
        'productName' => $productName,
        'productLine' => $productLine,
        'productScale' => $productScale,
        'productVendor' => $productVendor,
        'productDescription' => $productDescription,
        'quantityInStock' => $quantityInStock,
        'buyPrice' => $buyPrice,
        'MSRP' => $MSRP,
      ];

      create('products', $data);

    }
  }
}
// отримання змiнних з бд для заповнення форми Edit product з допомогою get параметра
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_update'])) {
  $id = $_GET['id_update'];
  $product = readOne($id);
  $productCode = $product['productCode'];
  $productName = $product['productName'];
  $productLine = $product['productLine'];
  $productScale = $product['productScale'];
  $productVendor = $product['productVendor'];
  $productDescription = $product['productDescription'];
  $quantityInStock = $product['quantityInStock'];
  $buyPrice = $product['buyPrice'];
  $MSRP = $product['MSRP'];

}

// змiна продукту
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {

  $productName = isset($_POST['productName']) ? $_POST['productName'] : '';
  $productLine = isset($_POST['productLine']) ? $_POST['productLine'] : '';
  $productScale = isset($_POST['productScale']) ? $_POST['productScale'] : '';
  $productVendor = isset($_POST['productVendor']) ? $_POST['productVendor'] : '';
  $productDescription = isset($_POST['productDescription']) ? $_POST['productDescription'] : '';
  $quantityInStock = isset($_POST['quantityInStock']) ? $_POST['quantityInStock'] : '';
  $buyPrice = isset($_POST['buyPrice']) ? $_POST['buyPrice'] : '';
  $MSRP = isset($_POST['MSRP']) ? $_POST['MSRP'] : '';

  $id = $_POST['id'];
  $data = [

    'productName' => $productName,
    'productLine' => $productLine,
    'productScale' => $productScale,
    'productVendor' => $productVendor,
    'productDescription' => $productDescription,
    'quantityInStock' => $quantityInStock,
    'buyPrice' => $buyPrice,
    'MSRP' => $MSRP,
  ];

  update('products', $id, $data);

  header('location: /db/pdo/index.phtml ');
}

// видалення продукту
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_delete'])) {
  $id = $_GET['id_delete'];
  deletes($id);
  header('location: /db/pdo/index.phtml ');

}

$products = readAll();