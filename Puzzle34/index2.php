<?php
$debut = microtime(true);
$data = fopen('data.txt', 'r');
$DataArray=array();

$NbCycles=6;
$z=0;
$w=0;
$x=0;
while(!feof($data)){
	$Line = fgets($data);
	$Line = str_split(trim($Line));
	for($y=0;$y<count($Line);$y++){
		$DataArray[$x][$y][$z][$w]=$Line[$y];
	}
	$x++;
}


function nbNeighboursActive($DataArray,$x,$y,$z,$w){
	$nbNeighbours=0;
	for($i=$x-1;$i<=$x+1;$i++){
		for($j=$y-1;$j<=$y+1;$j++){
			for($k=$z-1;$k<=$z+1;$k++){
				for($l=$w-1;$l<=$w+1;$l++){
					if(!($x==$i && $y==$j && $z==$k && $w==$l)){
						if(isset($DataArray[$i][$j][$k][$l])){
							if($DataArray[$i][$j][$k][$l]=="#"){
								$nbNeighbours++;
							}
						}					
					}
				}
			}
		}
	}
	return $nbNeighbours;
}

$MinI=array_key_first($DataArray);$MaxI=array_key_last($DataArray);
$MinJ=array_key_first($DataArray[0]);$MaxJ=array_key_last($DataArray[0]);
$MinK=array_key_first($DataArray[0][0]);$MaxK=array_key_last($DataArray[0][0]);
$MinL=array_key_first($DataArray[0][0][0]);$MaxL=array_key_last($DataArray[0][0][0]);

$DataArray_ref=$DataArray;

for($c=1;$c<=$NbCycles;$c++){
	for($i=$MinI-$c;$i<=$MaxI+$c;$i++){
		for($j=$MinJ-$c;$j<=$MaxJ+$c;$j++){	
			for($k=$MinK-$c;$k<=$MaxK+$c;$k++){
				for($l=$MinL-$c;$l<=$MaxL+$c;$l++){
					$nbNeighboursAct=nbNeighboursActive($DataArray_ref,$i,$j,$k,$l);
					if(!isset($DataArray_ref[$i][$j][$k][$l])){
						if($nbNeighboursAct==3){
								$DataArray[$i][$j][$k][$l]="#";
						}
					}else{
						if($DataArray_ref[$i][$j][$k][$l]=="#"){
							if($nbNeighboursAct<2 || $nbNeighboursAct>3){
								$DataArray[$i][$j][$k][$l]=".";
							}
						}elseif($nbNeighboursAct==3){
								$DataArray[$i][$j][$k][$l]="#";
						}
					}
				}
			}
		}
	}
	$DataArray_ref=$DataArray;
}

$NbActive=0;
foreach($DataArray as $Keyx=>$Valx){
	foreach($DataArray[$Keyx] as $Keyy=>$Valy){
		foreach($DataArray[$Keyx][$Keyy] as $Keyz=>$Valz){
			foreach($DataArray[$Keyx][$Keyy][$Keyz] as $Keyw=>$Valw){
				if($DataArray[$Keyx][$Keyy][$Keyz][$Keyw]=="#"){
					$NbActive++;
				}
			}
		}
	}
}
echo $NbActive;

$fin = microtime(true);

echo "<br><br>temps : ".($fin - $debut);
?>