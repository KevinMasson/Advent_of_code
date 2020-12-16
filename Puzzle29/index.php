<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}

$Number=explode(",",$DataArray[0]);
for($i=count($Number);$i<2020;$i++){
	$Sub_array=array_slice($Number,0,count($Number)-1);
	if(!in_array(end($Number),$Sub_array)){
		array_push($Number,"0");
	}else{
		while(end($Sub_array)!=end($Number)){array_pop($Sub_array);}
		array_push($Number,strval((count($Number))-(count($Sub_array))));
	}
}

echo end($Number);
var_dump($Number);



?>