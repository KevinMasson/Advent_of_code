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
$WayPoint=array("E"=>10,"S"=>0,"W"=>0,"N"=>1);

for($i=0;$i<count($DataArray);$i++){
	$Action = $DataArray[$i][0];
	$Unit = substr($DataArray[$i],1);
	if(array_key_exists($Action,$Direction)){
		$WayPoint[$Action]+=$Unit;
	}else{	
		switch ($Action){
			case "F" :
				foreach($Direction as $Key=> $Value){
					$Direction[$Key]+=($WayPoint[$Key]*$Unit);
				}
				break;
			case "L" :
			case "R" :
				for($j=0;$j<($Unit/90);$j++){
					foreach($WayPoint as $Key=>$Value){
						$WayPointW[$DirectionRose[$Key][$Action]]=$WayPoint[$Key];
					}
					$WayPoint=$WayPointW;
				}
				break;
		}
	}
}

echo abs($Direction["E"]-$Direction["W"])+abs($Direction["S"]-$Direction["N"]);

 


?>