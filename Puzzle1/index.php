<?php
/* hello ! */
/*Hello from web */
$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, $Line);
}
for($i=0;$i<count($DataArray);$i++){
	for($j=0;$j<count($DataArray);$j++){
		if(intval($DataArray[$i])+intval($DataArray[$j])==2020){
			$Entrie1=$i;
			$Entrie2=$j;
		}
	}
}
$Result = intval($DataArray[$Entrie1])*intval($DataArray[$Entrie2]);

echo $DataArray[$Entrie1]." * ".$DataArray[$Entrie2]. " = ".$Result;


?>
