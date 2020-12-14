<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}
$EarlierTime=$DataArray[0];
$Buses=explode(',',$DataArray[1]);
$Find=false;

$Time=$EarlierTime;
while (!$Find){
	foreach($Buses as $Key => $Value){
		if($Value!="x"){
			if($Time%$Value==0){
				$Find=true;
				$Response=0;
				$Id= $Value;
				for($i=0;$i<($Time/$Value);$i++){
					$Response+=$Value;
				}
			}
		}
	}
	$Time++;
}
echo $EarlierTime." ".$Response."<br>";
echo ($Response-$EarlierTime)*$Id;

?>