<?php
$TotalToSrc=2020;
$NbNumber =3;
$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray,str_split(trim($Line)));
}

function CheckAdjVisible($DataArray,$x,$y,$Car,$CarBloc=''){
	$Nbadj=0;
	$DX1=true;
	$DX2=true;
	$DY1=true;
	$DY2=true;
	$DD11=true;
	$DD12=true;
	$DD21=true;
	$DD22=true;
	$Id=1;
	$Nb["y"]=0;
	$Nb["x"]=0;
	$Nb["1"]=0;
	$Nb["2"]=0;
	while($DX1||$DY1||$DD11||$DD21 || $DX2||$DY2||$DD12||$DD22){
		/*y*/
		if($DY1){
			if($y+$Id<count($DataArray[$x])){
				if($DataArray[$x][$y+$Id]==$Car){
					$Nbadj++;$DY1=false;
					$Nb["y"]++;
				}elseif($DataArray[$x][$y+$Id]==$CarBloc){
					$DY1=false;
				}
			}else{$DY1=false;}
		}
		if($DY2){
			if($y-$Id>=0){
				if($DataArray[$x][$y-$Id]==$Car ){
					$Nbadj++;$DY2=false;$Nb["y"]++;
				}elseif($DataArray[$x][$y-$Id]==$CarBloc){
					$DY2=false;
				}
			}else{$DY2=false;}
		}
		/*x*/
		if($DX1){
			if($x+$Id<count($DataArray)){
				if($DataArray[$x+$Id][$y]==$Car){
					$Nbadj++;$DX1=false;$Nb["x"]++;
				}elseif( $DataArray[$x+$Id][$y]==$CarBloc){
					$DX1=false;
				}
			}else{$DX1=false;}
		}
		if($DX2){
			if($x-$Id>=0){
				if($DataArray[$x-$Id][$y]==$Car){
					$Nbadj++;
					$DX2=false;$Nb["x"]++;
				}elseif( $DataArray[$x-$Id][$y]==$CarBloc){
					$DX2=false;
				}
			}else{$DX2=false;}
		}
		/*diag1*/
		if($DD11){
			if($x+$Id<count($DataArray)){
				if($y+$Id<count($DataArray[$x+$Id])){
					if($DataArray[$x+$Id][$y+$Id]==$Car ){
						$Nbadj++;$DD11=false;$Nb["1"]++;
					}elseif($DataArray[$x+$Id][$y+$Id]==$CarBloc){
						$DD11=false;
					}
				}
			}else{$DD11=false;}
		}
		if($DD12){
			if($x-$Id>=0){
				if($y-$Id>=0){
					if($DataArray[$x-$Id][$y-$Id]==$Car){
						$Nbadj++;$DD12=false;$Nb["1"]++;
					}elseif($DataArray[$x-$Id][$y-$Id]==$CarBloc){
						$DD12=false;
					}
				}
			}else{$DD12=false;}
		}
		/*diag2*/
		if($DD21){
			if($x+$Id<count($DataArray)){
				if($y-$Id>=0){
					if($DataArray[$x+$Id][$y-$Id]==$Car){
						$Nbadj++;$DD21=false;$Nb["2"]++;
					}elseif($DataArray[$x+$Id][$y-$Id]==$CarBloc){
						$DD21=false;
					}
				}
			}else{$DD21=false;}
		}
		if($DD22){
			if($x-$Id>=0){
				if($y+$Id<count($DataArray[$x-$Id])){
					if($DataArray[$x-$Id][$y+$Id]==$Car){
						$Nbadj++;$DD22=false;$Nb["2"]++;
					}elseif($DataArray[$x-$Id][$y+$Id]==$CarBloc){
						$DD22=false;
					}
				}
			}else{$DD22=false;}
		}
		$Id++;
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
		echo $WorkTab[$i][$j];
		$NbOcc+=$WorkTab[$i][$j]=="#"? 1 : 0;	
	}
	echo "<br>";
}
echo "NbOcc : ".$NbOcc;
?>