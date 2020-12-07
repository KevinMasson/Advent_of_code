<?php

$data = fopen('data.txt', 'r');
$Qlist = array();
$Tot=0;
while(!feof($data)){
	$ResponseData=array();
	$Line = trim(fgets($data));
	$Empty=0;
	while((strlen($Line))>0){
		for($i=0;$i<strlen($Line);$i++){
			array_push($ResponseData,$Line[$i]);
		}
		$Line = trim(fgets($data));
	}
	$Tot+=count(array_unique($ResponseData));
}

echo "total : ".$Tot;



?>