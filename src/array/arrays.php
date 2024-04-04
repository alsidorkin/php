<?php 

echo '<pre>';



//get first element from array
$array = [1, 2, 3, 4, 5];
$firstElement = reset($array);
echo $firstElement; 


//get last element from array
$array = [1, 2, 3, 4, 5];
$lastElement = end($array);
echo $lastElement;


//remove middle element of array
$array = [1, 2, 3, 4, 5];
$middleIndex = floor(count($array) / 2);
unset($array[$middleIndex]);
print_r($array);


$array = [1, 2, 3, 4, 5];
$middleIndex = floor(count($array) / 2);
array_splice($array, $middleIndex, 1);
print_r($array);



//push element to array
$array = [1, 2, 3];
$element = 4;
array_push($array, $element);
print_r($array);


$array = [1, 2, 3];
$element = 4;
$array[] = $element;
print_r($array);
