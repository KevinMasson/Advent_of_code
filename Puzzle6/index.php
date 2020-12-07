<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, $Line);
}
$Largeur = strlen($DataArray[0])-2;
$Hauteur = count($DataArray);
$StartPoint=array(0,0);
echo "StartPoint : ".$StartPoint[0]."-".$StartPoint[1]."<br>";

echo "Largeur : ".$Largeur."<br>";
echo "Hauteur : ".$Hauteur."<br>";

$Slopes = array(array(1,1),array(3,1),array(5,1),array(7,1),array(1,2));
$Total=1;
foreach($Slopes as $Slope){
	$NbTrees=0;
	echo "------------------------------".$Slope[0].' '.$Slope[1]."<br>";
	$Point=$StartPoint;
	While($Point[1]<$Hauteur){
		$Point[0]+=$Slope[0];
		$Point[1]+=$Slope[1];
		$P0=$Point[0]%$Largeur;
		$ligne=array();
		if($Point[1]<$Hauteur){
			if($DataArray[$Point[1]][$P0]=="#"){
				$NbTrees++;
			}
		}else{
			echo "FIN<br>";
		}
	}
	$Total*=$NbTrees;
	echo $NbTrees."<br>";
}
	echo $Total."<br>";
?>