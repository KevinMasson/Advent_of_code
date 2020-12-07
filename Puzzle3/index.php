<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, $Line);
}
$Ok=0;
for($i=0;$i<count($DataArray);$i++){
	$WorkTab=array();
	$WorkTab= explode(" ",$DataArray[$i]);
	$Nb=substr_count($WorkTab[2],str_replace(":","",$WorkTab[1]));
	if($Nb>=explode("-",$WorkTab[0])[0] && $Nb<=explode("-",$WorkTab[0])[1]){
		$Ok++;
	}
}
echo $Ok;


?>