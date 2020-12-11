<?php
$TotalToSrc=2020;
$NbNumber =3;
$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray,str_split(trim($Line)));
}

function CheckAdj($DataArray,$x,$y,$Car='#'){
	$Nbadj=0;
	for($i=$x-1;$i<=$x+1;$i++){
		for($j=$y-1;$j<=$y+1;$j++){
			if($i>=0 && $i<count($DataArray) && $j>=0 && $j<count($DataArray[$i])){
				if($DataArray[$i][$j]==$Car){$Nbadj++;}
			}
		}
	}
	$DataArray[$x][$y]==$Car ? $Nbadj--:0;
	return $Nbadj;
}

$WorkTab=$DataArray;
$PreviousWorkTab=array();
while ($PreviousWorkTab!=$WorkTab){
	$PreviousWorkTab=$WorkTab;
	for($i=0;$i<count($WorkTab);$i++){
		for($j=0;$j<count($WorkTab[$i]);$j++){
			switch($WorkTab[$i][$j]){
				case 'L' :
					$WorkTab[$i][$j]=(CheckAdj($PreviousWorkTab,$i,$j)==0 ? '#' :'L');
					break;
				case '.' :
					break;
				case '#' :
					$WorkTab[$i][$j]=(CheckAdj($PreviousWorkTab,$i,$j)<4 ? '#' :'L');
					break;
			}
		}
	}
}
$NbOcc=0;
for($i=0;$i<count($WorkTab);$i++){
	for($j=0;$j<count($WorkTab[$i]);$j++){
		$NbOcc+=$WorkTab[$i][$j]=="#"? 1 : 0;	
	}
}
echo "NbOcc : ".$NbOcc;
?>