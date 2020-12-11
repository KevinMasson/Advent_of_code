<?php
$TotalToSrc=2020;
$NbNumber =3;
$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray,str_split(trim($Line)));
}


function scroll($DataArray,$x,$y,$J,$Car,$CarBloc){
	$Nbadj=0;
	if(($x+$J[0])>=0 &&($x+$J[0]) <count($DataArray)){
		if(($y+$J[1])>=0 &&($y+$J[1]) <count($DataArray[($x+$J[0])])){
			$Car=$DataArray[($x+$J[0])][($y+$J[1])];
			switch(TRUE){
				case ($Car=='L') :
					break;
				case ($Car=='.') :
					$Nbadj+=scroll($DataArray,($x+$J[0]),($y+$J[1]),$J,$Car,$CarBloc='');
					break;
				case ($Car=='#') :
					$Nbadj++;
					break;
			}
		}
	}
	return $Nbadj;
}


function CheckAdjVisible($DataArray,$x,$y,$Car,$CarBloc){
	$Nbadj=0;
	$Jmp=array(array(-1,-1),array(-1,0),array(-1,1),array(0,-1),array(0,1),array(1,-1),array(1,0),array(1,1));
	foreach($Jmp as $J){
		$Nbadj+=scroll($DataArray,$x,$y,$J,$Car,$CarBloc);
	}
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
					$WorkTab[$i][$j]=(CheckAdjVisible($PreviousWorkTab,$i,$j,"#","L")==0 ? '#' :'L');
					break;
				case '.' :
					break;
				case '#' :
					$WorkTab[$i][$j]=(CheckAdjVisible($PreviousWorkTab,$i,$j,"#","L")<5 ? '#' :'L');
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