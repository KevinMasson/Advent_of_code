<?php
$debut = microtime(true);
$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}

$PlayData=array();
$i=0;
foreach(explode(',',$DataArray[0]) as $Data){
	$PlayData[$Data]=$i;
	$i++;
}

$EnCours=0;
for($i=count($PlayData);$i<30000000-1;$i++){
	if(array_key_exists($EnCours,$PlayData)){
			$Val=$i-$PlayData[$EnCours];
			$PlayData[$EnCours]=$i;
			$EnCours=$Val;
	}else{
		$PlayData[$EnCours]=$i;
		$EnCours=0;
	}
}
echo $EnCours;
$fin = microtime(true);
echo "<br><br>temps : ".($fin - $debut);

?>