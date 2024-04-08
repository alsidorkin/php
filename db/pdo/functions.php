<?php
require_once 'connect.php';

// функцiя створення продукту в бд
function create($table, $params)
{

    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }
    $query = $pdo->prepare("INSERT INTO $table ($coll) VALUES ($mask)");
    $query->execute();
}

// функцiя читання 
function readAll()
{
    global $pdo;
    $sql = "SELECT * FROM products ";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function readOne($id)
{
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM products WHERE productCode = ?");
    $query->execute([$id]);
    return $query->fetch();
}

// функцiя змiни
function update($table, $id, $params)
{
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {

            $str = $str . $key . " = '" . $value . "'";
        } else {

            $str = $str . ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }

    $query = $pdo->prepare("UPDATE $table SET $str WHERE productCode = ?");
    $query->execute([$id]);

}
// функцiя видалення
function deletes($id)
{
    global $pdo;
    $query = $pdo->prepare("DELETE FROM products WHERE `productCode` = ?");
    $query->execute([$id]);
}
