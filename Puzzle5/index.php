<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, $Line);
}
$Largeur = strlen($DataArray[0])-2;
$Hauteur = count($DataArray);
$SlopeX=3;
$SlopeY=1;
$StartPoint = array(0,0);

echo "StartPoint : ".$StartPoint[0]."-".$StartPoint[1]."<br>";
echo "Déplacement : ".$SlopeX." - ".$SlopeY."<br><br>";

echo "Largeur : ".$Largeur."<br>";
echo "Hauteur : ".$Hauteur."<br>";


$Multi=round(((($Hauteur*$SlopeX)+1)/$Largeur)+1);
echo "Multi : ".$Multi."<br>";

$NbTrees=0;
$Point=$StartPoint;
for($i=1;$i<$Hauteur;$i++){
	echo trim($DataArray[$i])."|||||  ";
	$Point[0]+=$SlopeX;
	$Point[1]+=$SlopeY;
	$ligne=array();
	for($j=0;$j<$Multi;$j++){
		$ligne=array_merge($ligne,str_split(trim($DataArray[$i])));
	}
	echo $Point[0] ." -- ".$ligne[$Point[0]];
	if($ligne[$Point[0]]=="#"){
		$NbTrees++;
		echo " ------- PAF";
	}
	echo "<br>";
	
}
echo $NbTrees;

?>