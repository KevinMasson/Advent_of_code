<?php

$data = fopen('data.txt', 'r');
$DataArray=array();

while(!feof($data)){
	$Line = explode(" ",trim(fgets($data)));
	
	array_push($DataArray, $Line);
}

function check($Data){
	$Acc=0;
	$Tour=1;
	$Cpt=0;
	$Parcours=array();

	while ($Cpt<count($Data)){
		$Action=$Data[$Cpt][0];
		$Inc=$Data[$Cpt][1];
		if(in_array($Cpt,$Parcours)){
			$Acc=0;
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
	if($Tour==1){
		return $Acc;
	}else{
		return 0;
	}
}
$ArrayI=array();
for($i=0;$i<=count($DataArray)-1;$i++){
	if($DataArray[$i][0]=="nop" ||$DataArray[$i][0]=="jmp"){
		array_push($ArrayI,$i);
	}
}
for($i=0;$i<=count($DataArray)-1;$i++){
	$Tab=$DataArray;
	$Tab[$i][0] = $Tab[$i][0]=="nop" ? "jmp" : "nop";
	$Res=check($Tab);
	if($Res!=0){
		echo$Res."<br>";
	}
}

?>