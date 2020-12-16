<?php
$debut = microtime(true);
$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}
$Number=explode(",",$DataArray[0]);
$Values=array();
for($i=0;$i<count($Number);$i++){
	$Values[$Number[$i]]=$i;
}


/* Algo ok mais troooop long*/
/*
for($i=count($Number);$i<2020;$i++){
	$Sub_array=$Number;
	array_pop($Sub_array);
	if(!in_array(end($Number),$Sub_array)){
		$LastId[end($Number)]=$i-1;
		array_push($Number,"0");
	}else{
		$Last=end($Number);
		array_push($Number,strval(($i-1)-$LastId[end($Number)]));
		$LastId[$Last]=$i-1;
	}
}
echo end($Number)."<br><br>";
*/
$fin = microtime(true);

echo "<br><br>temps : ".($fin - $debut);


?>