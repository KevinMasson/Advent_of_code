<?php
$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, $Line);
}
$Links=array();
foreach($DataArray as  $Line){
	$Line=str_replace("bags.","",$Line);
	$Line=str_replace("bags","",$Line);
	$Line=str_replace("bag.","",$Line);
	$Line=str_replace("bag","",$Line);
	$NodeParent = explode("contain ",$Line)[0];
	$NodeChilds=explode(", ",explode("contain ",$Line)[1]);
	$Node=array();
	foreach($NodeChilds as $NodeChild){
		if(trim($NodeChild)!="no other"){
			$Nb=intval(substr($NodeChild,0,1));
			$Key=trim(strstr($NodeChild," "));
			$Node[$Key]=$Nb;
		}
	}
	$Links[trim($NodeParent)]=$Node;
}


function r($Color,$Links){
	$Colors=array($Color);
	foreach($Links[$Color] as $SubCol => $Nb){
		$SubColors=r($SubCol,$Links);
		$Colors=array_merge($Colors,$SubColors);
	}
	return $Colors;
}

$Total=0;
foreach($Links as $Color=>$SubColors){
	if($Color!="shiny gold" && in_array("shiny gold",r($Color,$Links))){
		$Total++;
	}
}

echo $Total;

?>
