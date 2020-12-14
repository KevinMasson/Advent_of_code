<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}
$EarlierTime=$DataArray[0];
$Buses=explode(',',$DataArray[1]);

$BusesT=array();
for($i=1;$i<count($Buses);$i++){
	if($Buses[$i]!="x"){
		$BusesT[$Buses[$i]]=$i;
	}
}

$Index=$Buses[0];
$J=$Buses[0];
var_dump($BusesT);

foreach($BusesT as $IdBus=>$Idx){
	while(($Index+$Idx)%$IdBus!=0){
		$Index+=$J;
	}
	$J*=$IdBus;
}
echo $Index;



?>