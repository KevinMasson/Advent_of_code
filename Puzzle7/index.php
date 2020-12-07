<?php

$data = fopen('data.txt', 'r');

$Passports = array();
$NeededFields = array("byr","iyr","eyr","hgt","hcl","ecl","pid");

while(!feof($data)){
	$FieldsData=array();
	$Line = fgets($data);
	while((strlen($Line)-2)>0){
		$L = explode(" ",trim($Line));
		foreach($L as $Fields){
			$F=explode(":",$Fields);
			$FieldsData[$F[0]]=$F[1];
		}
		$Line = fgets($data);
	}
	array_push($Passports,$FieldsData);
}
$Valid_Passorts=0;
foreach($Passports as $Passport){
	$OK=0;
	foreach ($NeededFields as $NeededField){
		if(array_key_exists($NeededField,$Passport)){
			$OK++;
		}
	}
	if($OK==count($NeededFields)){
		echo "OK <br>";
		$Valid_Passorts++;
	}else{
		echo "KO <br>";
	}

}
echo "passports valides : ".$Valid_Passorts;
?>