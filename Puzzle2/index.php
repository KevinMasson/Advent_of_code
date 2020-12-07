<?php
$TotalToSrc=2020;
$NbNumber =3;
$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, $Line);
}
$TabLenth = count($DataArray);
$Find=false;

while(!$Find){
	$Tot=0;
	$Values=array();
	for($i=0;$i<=$NbNumber;$i++){
		$Alea=rand(0,$TabLenth-1);
		array_push($Values,$Alea);
		$Tot+=intval($DataArray[$Alea]);
	}
	if($Tot==$TotalToSrc){
		$Find=true;
	}
}
$Tot=1;
for($i=0;$i<=$NbNumber;$i++){
	echo $DataArray[$Values[$i]]."<br>";
	$Tot*=$DataArray[$Values[$i]];
}
echo $Tot;
/*
for($i=0;$i<count($DataArray);$i++){
	for($j=0;$j<count($DataArray);$j++){
		for($k=0;$k<count($DataArray);$k++){
			if(intval($DataArray[$i])+intval($DataArray[$j])+intval($DataArray[$k])==$TotalToSrc){
				$Entrie1=$i;
				$Entrie2=$j;
				$Entrie3=$k;
			}
		}
	}
}
$Result = intval($DataArray[$Entrie1])*intval($DataArray[$Entrie2])*intval($DataArray[$Entrie3]);

echo $DataArray[$Entrie1]." * ".$DataArray[$Entrie2]." * ".$DataArray[$Entrie3]. " = ".$Result;
*/
?>