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
		$F=array();
		foreach(explode(" or ",$Intervals) as $Interval){
			array_push($F,array("Min"=>explode("-",$Interval)[0],"Max"=>explode("-",$Interval)[1]));
		}
		$Fields[$Field]=$F;
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

/* récupération des tickets ok */
$Res=array();
$TicketOK=array();
for($i=0;$i<count($NearbyTicket);$i++){
	$IsOk=true;
	$Values=explode(",",$NearbyTicket[$i]);
	for($j=0;$j<count($Values);$j++){
		$Match=false;
		foreach($Fields as $Field=>$Cond){
			for($k=0;$k<count($Cond);$k++){
				if(intval($Values[$j])>=$Cond[$k]["Min"] && intval($Values[$j])<=$Cond[$k]["Max"]){
					$Match=true;
				}
			}
		}
		if(!$Match){
			array_push($Res,$Values[$j]);
			$IsOk=false;
		}
	}
	if($IsOk===true){
		array_push($TicketOK,$NearbyTicket[$i]);
	}
}
//var_dump($Res);
//echo array_sum($Res);
//var_dump($NearbyTicket);
//var_dump($TicketOK);

/* check des tickets Ok */
$Corres=array();
for($i=0;$i<count(explode(",",$TicketOK[0]));$i++){
	foreach($Fields as $Field=>$Cond){
		$Corres[$Field][$i]=true;
	}
}
for($i=0;$i<count($TicketOK);$i++){
	$Values=explode(",",$TicketOK[$i]);
	for($j=0;$j<count($Values);$j++){
		foreach($Fields as $Field=>$Cond){
			$Match=false;
			for($k=0;$k<count($Cond);$k++){
				if(intval($Values[$j])>=$Cond[$k]["Min"] && intval($Values[$j])<=$Cond[$k]["Max"]){
					$Match=true;
				}
			}
			if(!$Match){
				$Corres[$Field][$j]=false;
			}
		}
	}
}

foreach($Corres as $Fields=>$Match){
	for($i=0;$i<count($Match);$i++){
		if(!$Match[$i]){
			unset($Corres[$Fields][$i]);
		}
	}
}
$Res=array();
while(count($Res)<20){
	foreach($Corres as $Fields=>$Match){
		if(count($Corres[$Fields])==1){
			$Key=key($Corres[$Fields]);
			$Res[$Fields]=$Key;
			foreach($Corres as $F=>$M){
				unset($Corres[$F][$Key]);
			}
		}
	}
}
$Val=array();
$MyTicket=explode(",",$MyTicket[0]);
foreach($Res as $Field => $Id){
	if(substr($Field,0,9)=="departure"){
		array_push($Val,$MyTicket[$Id]);
	}
}
echo array_product($Val);

?>