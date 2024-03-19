<?php   
$data = file_get_contents('https://dog.ceo/api/breeds/image/random');
$result= json_decode($data, true);
?> 

<img src="<?=$result['message']?>" alt="">