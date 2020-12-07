<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}

$RowsNumber=127;
$ColsNumber=7;
$MaxId=0;
foreach($DataArray as $Data){
	$RowMin=0;
	$RowMax=$RowsNumber;
	$ColMin=0;
	$ColMax=$ColsNumber;
	$IdC=0;
	$IdR=0;	
	
	$Data=str_replace('F', '0',$Data);
	$Data=str_replace('B', '1',$Data);
	$Data=str_replace('L', '0',$Data);
	$Data=str_replace('R', '1',$Data);
	$Id=bindec($Data);

	$Ids[$Id]=1;
	if($MaxId<$Id){$MaxId=$Id;}
	
}
echo "max : ".$MaxId;


?>