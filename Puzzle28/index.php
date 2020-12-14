<?php
$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, trim($Line));
}
$Var=array();
for($i=0;$i<count($DataArray);$i++){
	if((explode(" = ",$DataArray[$i])[0])=="mask"){
		$Mask=explode(" = ",$DataArray[$i])[1];
	}else{
		$Key=explode(" = ",$DataArray[$i])[0];
		$Val=strval(explode(" = ",$DataArray[$i])[1]);
		var_dump($Val);
		$Key=str_replace("]","",str_replace("mem[","",$Key));
		$KeyBit=strval(decbin($Key));
		while(strlen($KeyBit)<36){$KeyBit="0".$KeyBit;}
		for($j=0;$j<36;$j++){
			switch($Mask[$j]){
				case "0":
					break;
				case "1":
					$KeyBit[$j]=1;
					break;
				case "X":
					$KeyBit[$j]="X";
					break;
			}
		}
		$Adresses = getAllAdresses($KeyBit);
		foreach($Adresses as $Adresse){
			$Var[bindec($Adresse)]=$Val;
		}
	}
}

var_dump($Var);
echo array_sum($Var);

function getAllAdresses($Adress){
	$Res=array();
	if(strpos($Adress,"X")===false){
		$Res=array_merge($Res,array($Adress));
	}else{
		$Adr=str_split($Adress);
		$Adr[strpos($Adress,"X")]="1";
		$Res=array_merge($Res,getAllAdresses(implode("",$Adr)));
		$Adr=str_split($Adress);
		$Adr[strpos($Adress,"X")]="0";
		$Res=array_merge($Res,getAllAdresses(implode("",$Adr)));
	}
	return $Res;
}

?>