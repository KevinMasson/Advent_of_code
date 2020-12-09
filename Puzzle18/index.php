<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}

$StartI=0;
$Range=25;
$Valid=true;
$RangeInProgress=array($StartI,$Range-1);
$Cpt=$Range;


function isValid($Value,$Range,$DataArray){
	$Valid=false;
	for($Cpt1=$Range[0];$Cpt1<=$Range[1];$Cpt1++){
		for($Cpt2=$Range[0];$Cpt2<=$Range[1];$Cpt2++){
			//echo $Cpt1." ".$Cpt2." ".$DataArray[$Cpt1]." ".$DataArray[$Cpt2]." ".$Value."<br>";
			if($Cpt1!=$Cpt2 && $DataArray[$Cpt1]+$DataArray[$Cpt2]==$Value){
				$Valid=true;
			}
		}	
	}
	return $Valid;
}

while($Valid){
	if(!isValid($DataArray[$Cpt],$RangeInProgress,$DataArray)){break;}
	$Cpt++;
	$RangeInProgress[0]=$RangeInProgress[0]+1;
	$RangeInProgress[1]=$RangeInProgress[1]+1;
}
echo "invalid : ".$DataArray[$Cpt]."<br>";

for($i=$StartI;$i<$Cpt;$i++){
	$Tab=array_slice($DataArray,$i);
	while(count($Tab)>0){
		if(array_sum($Tab)==$DataArray[$Cpt]){
			echo min($Tab)." ".max($Tab)." = ".(min($Tab)+max($Tab))."<br>";
		}
		array_pop($Tab);
	}
}


?>