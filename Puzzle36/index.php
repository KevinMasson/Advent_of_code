<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}

function operation($Line){
	$Data=explode(" * ",$Line);
	$SubTotaux=array();
	foreach($Data as $D){
		array_push($SubTotaux,array_sum(explode(" + ",$D)));
	}
	return array_product($SubTotaux);
}


function getMaxLevelParenthesis($Var){
	global $LevelMax;
	return $Var["level"]==$LevelMax;
}
$Total=0;
for($Cpt=0;$Cpt<count($DataArray);$Cpt++){
	$Data=str_split($DataArray[$Cpt]);
	while(in_array("(",$Data)){
		$level=0;
		$LevelMax=0;
		$Parenthesis=array();
		for($i=0;$i<count($Data);$i++){
			if($Data[$i]=="("){
				$level++;
				array_push($Parenthesis,array("s"=>$i,"e"=>-1,"level"=>$level));
				$LevelMax=max($level,$LevelMax);
			}
			if($Data[$i]==")"){
				for($j=count($Parenthesis)-1;$j>=0;$j--){
					if($Parenthesis[$j]["e"]==-1){
						$Parenthesis[$j]["e"]=$i;
						break;
					}
				}
				$level--;
			}
		}
		$SubOperation=array_filter($Parenthesis,"getMaxLevelParenthesis");
		$Line=$LineOk=implode("",$Data);
		
		foreach($SubOperation as $Key=>$Value){
			$Val=operation(substr($Line,$SubOperation[$Key]["s"]+1,$SubOperation[$Key]["e"]-$SubOperation[$Key]["s"]-1));
			$LineOk=str_replace(substr($Line,$SubOperation[$Key]["s"],$SubOperation[$Key]["e"]-$SubOperation[$Key]["s"]+1),$Val,$LineOk);
		}
		$Data=str_split($LineOk);
	}
	$Total+=operation(implode("",$Data));
}

echo $Total;

?>