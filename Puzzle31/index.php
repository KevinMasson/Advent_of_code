<?php

$data = fopen('data.txt', 'r');

$Fields=array();
$MyTicket=array();
$NearbyTicket=array();

while(!feof($data)){
	$Line = trim(fgets($data));	
	while($Line!=""){
		$Field=explode(": ",$Line)[0];
		$Intervals=explode(": ",$Line)[1];
		foreach(explode(" or ",$Intervals) as $Interval){
			array_push($Fields,array("Fields"=>$Field,"Min"=>explode("-",$Interval)[0],"Max"=>explode("-",$Interval)[1]));
		}
		$Line = trim(fgets($data));	
	}
	$Line = trim(fgets($data));
	$Line = trim(fgets($data));
	while($Line!=""){
		array_push($MyTicket,$Line);
		$Line = trim(fgets($data));	
	}
	$Line = trim(fgets($data));
	while(!feof($data)){
		$Line = trim(fgets($data));	
		array_push($NearbyTicket,$Line);
	}
}
$Res=array();
for($i=0;$i<count($NearbyTicket);$i++){
	$Values=explode(",",$NearbyTicket[$i]);
	for($j=0;$j<count($Values);$j++){
		$Match=false;
		for($k=0;$k<count($Fields);$k++){
			if(intval($Values[$j])>=$Fields[$k]["Min"] && intval($Values[$j])<=$Fields[$k]["Max"]){
				$Match=true;
			}
		}
		if(!$Match){
			array_push($Res,$Values[$j]);
		}
	}
}
echo array_sum($Res);


?>