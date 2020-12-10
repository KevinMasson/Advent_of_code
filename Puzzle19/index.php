<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, intval(trim($Line)));
}

sort($DataArray);
$Diff=array("1"=>0,"3"=>0);
$Diff[$DataArray["0"]]++;
for($i=0;$i<count($DataArray)-1;$i++){
	$D=$DataArray[$i+1]-$DataArray[$i];
	$Diff[$D]++;
}
$Diff["3"]++;
echo ($Diff["1"]*$Diff["3"]);
?>