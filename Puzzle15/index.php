<?php

$data = fopen('data.txt', 'r');
$DataArray=array();

while(!feof($data)){
	$Line = explode(" ",trim(fgets($data)));
	
	array_push($DataArray, $Line);
}

function check($Data){
	$Acc=0;
	$Cpt=0;
	$Parcours=array();

	while ($Cpt<count($Data)){
		$Action=$Data[$Cpt][0];
		$Inc=$Data[$Cpt][1];
		if(in_array($Cpt,$Parcours)){
			break;
		}else{
			array_push($Parcours,$Cpt);
			switch ($Action){
				case "nop" :
					$Cpt++;
				break;
				case "acc" :
					$Cpt++;
					$Acc+=$Inc;
				break;
				case "jmp" :
					$Cpt+=$Inc;
				break;		
			}
		}
	}
	return $Acc;
}
echo check($DataArray)."<br>";


?>