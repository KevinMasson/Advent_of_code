<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}

$Direction=array("E"=>0,"S"=>0,"W"=>0,"N"=>0);
$DirectionRose=array(
					"E"=>array("L"=>"N","R"=>"S"),
					"S"=>array("L"=>"E","R"=>"W"),
					"W"=>array("L"=>"S","R"=>"N"),
					"N"=>array("L"=>"W","R"=>"E"),
					);
$ActualDirection="E";
for($i=0;$i<count($DataArray);$i++){
	$Action = $DataArray[$i][0];
	$Unit = substr($DataArray[$i],1);
	if(array_key_exists($Action,$Direction)){
		$Direction[$Action]+=$Unit;
	}else{	
		switch ($Action){
			case "F" :
				$Direction[$ActualDirection]+=$Unit;
				break;
			case "L" :
			case "R" :
				for($j=0;$j<($Unit/90);$j++){
					$ActualDirection=$DirectionRose[$ActualDirection][$Action];
				}
				break;
		}
	}
}

var_dump($Direction);
echo abs($Direction["E"]-$Direction["W"])+abs($Direction["S"]-$Direction["N"]);

 


?>