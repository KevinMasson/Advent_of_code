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
	$Multi=round(((($Hauteur*$Slope[0])+1)/$Largeur)+1);
	echo "Multi : ".$Multi."<br>";
	$NbTrees=0;
	echo "------------------------------".$Slope[0].' '.$Slope[1]."<br>";
	$Point=$StartPoint;
	While($Point[1]<$Hauteur){
		$Point[0]+=$Slope[0];
		$Point[1]+=$Slope[1];
		$ligne=array();
		if($Point[1]<$Hauteur){
			for($j=0;$j<$Multi;$j++){
				$ligne=array_merge($ligne,str_split(trim($DataArray[$Point[1]])));
			}
			//echo $Point[0] ." -- ".$ligne[$Point[0]];
			if($ligne[$Point[0]]=="#"){
				$NbTrees++;
				//echo " ------- PAF";
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