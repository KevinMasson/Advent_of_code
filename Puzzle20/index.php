<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, intval(trim($Line)));
}
sort($DataArray);

array_push($DataArray,$DataArray[count($DataArray)-1]+3);

var_dump($DataArray);

$Nb[0]=1;
$LastId=0;
for($i=0;$i<count($DataArray)-1;$i++){
	$Inc=0;
	for($j=1;$j<=3;$j++){
		$Inc+=(array_key_exists($DataArray[$i]-$j,$Nb)? $Nb[$DataArray[$i]-$j] : 0);
	}
	$Nb[$DataArray[$i]] = $Inc;
	if($LastId <$DataArray[$i]){$LastId=$DataArray[$i];}
}
echo($Nb[$LastId]);

?>
