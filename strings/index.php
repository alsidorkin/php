<?php 
// 1.
$findme    = 'a';
$mystring1 = 'xyz';
$mystring2 = 'ABC';

$pos1 = stripos($mystring1, $findme);
$pos2 = stripos($mystring2, $findme);

if ($pos1 === false) {
    echo "Строка '$findme' не найдена в строке '$mystring1'";
}

if ($pos2 !== false) {
    echo "Нашёл '$findme' в '$mystring2' в позиции $pos2";
}


// 2.
$str = 'abcdef';
echo strlen($str); 


// 3.
$fruits = ["лимон", "апельсин", "банан"];
echo implode(" и ", $fruits); 


// 4.
$pizza  = "кусок1 кусок2 кусок3 кусок4 кусок5 кусок6";
$pieces = explode(" ", $pizza);
echo $pieces[0]; 
echo $pieces[1]; 


// 5.
$str = "A 'quote' is <b>bold</b>";
echo htmlentities($str);


//6.
$str = 'яблоко';

if (md5($str) === '1afa148eb41f2e7103f21410bf48346c') {
    echo "Вам зелёное или красное яблоко?";
}



// 7.
$text   = "\t\tThese are a few words :) ...  ";
$binary = "\x09Example string\x0A";
$hello  = "Hello World";
var_dump($text, $binary, $hello);

print "\n";

$trimmed = trim($text);
var_dump($trimmed);

$trimmed = trim($text, " \t.");
var_dump($trimmed);

$trimmed = trim($hello, "Hdle");
var_dump($trimmed);

$trimmed = trim($hello, 'HdWr');
var_dump($trimmed);



// 8.
echo strrev("Hello world!"); 


// 9.
$text = 'This is a Simple text.';
echo strpbrk($text, 'mi');
echo strpbrk($text, 'S');


// 10.
$str = "Hello Friend";

$arr1 = str_split($str);
$arr2 = str_split($str, 3);

print_r($arr1);
print_r($arr2);