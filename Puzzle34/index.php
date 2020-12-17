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

function Expend($Array,$NbCycles,$MinI,$MaxI,$MinJ,$MaxJ,$MinK,$MaxK,$MinL,$MaxL){
	$ArrayRes=array();
	for($i=$MinI-$NbCycles;$i<=$MaxI+$NbCycles;$i++){
		for($j=$MinJ-$NbCycles;$j<=$MaxJ+$NbCycles;$j++){
			for($k=$MinK-$NbCycles;$k<=$MaxK+$NbCycles;$k++){
				for($l=$MinL-$NbCycles;$l<=$MaxL+$NbCycles;$l++){
					if(!isset($Array[$i][$j][$k][$l])){
						$ArrayRes[$i][$j][$k][$l]=".";
					}else{
						$ArrayRes[$i][$j][$k][$l]=$Array[$i][$j][$k][$l];
					}
				}
			}
		}
	}
	return $ArrayRes;
}
$MinI=array_key_first($DataArray);$MaxI=array_key_last($DataArray);
$MinJ=array_key_first($DataArray[0]);$MaxJ=array_key_last($DataArray[0]);
$MinK=array_key_first($DataArray[0][0]);$MaxK=array_key_last($DataArray[0][0]);
$MinL=array_key_first($DataArray[0][0][0]);$MaxL=array_key_last($DataArray[0][0][0]);

$ArrayExpended_Ref=Expend($DataArray,$NbCycles,$MinI,$MaxI,$MinJ,$MaxJ,$MinK,$MaxK,$MinL,$MaxL);
$ArrayExpended=$ArrayExpended_Ref;

for($c=0;$c<$NbCycles;$c++){
	foreach($ArrayExpended_Ref as $Keyx=>$Valx){
		foreach($ArrayExpended_Ref[$Keyx] as $Keyy=>$Valy){
			foreach($ArrayExpended_Ref[$Keyx][$Keyy] as $Keyz=>$Valz){
				foreach($ArrayExpended_Ref[$Keyx][$Keyy][$Keyz] as $Keyw=>$Valw){
					$nbNeighboursAct=nbNeighboursActive($ArrayExpended_Ref,$Keyx,$Keyy,$Keyz,$Keyw);
					if($ArrayExpended_Ref[$Keyx][$Keyy][$Keyz][$Keyw]=="#"){
						if($nbNeighboursAct<2 || $nbNeighboursAct>3){
							$ArrayExpended[$Keyx][$Keyy][$Keyz][$Keyw]=".";
						}
					}else{
						//if($ArrayExpended_Ref[$Keyx][$Keyy][$Keyz][$Keyw]=="."){
						if($nbNeighboursAct==3){
							$ArrayExpended[$Keyx][$Keyy][$Keyz][$Keyw]="#";
						}
					}
				}
			}
		}
	}
	$ArrayExpended_Ref=$ArrayExpended;
}
$NbActive=0;
foreach($ArrayExpended as $Keyx=>$Valx){
	foreach($ArrayExpended[$Keyx] as $Keyy=>$Valy){
		foreach($ArrayExpended[$Keyx][$Keyy] as $Keyz=>$Valz){
			foreach($ArrayExpended_Ref[$Keyx][$Keyy][$Keyz] as $Keyw=>$Valw){
				if($ArrayExpended[$Keyx][$Keyy][$Keyz][$Keyw]=="#"){
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