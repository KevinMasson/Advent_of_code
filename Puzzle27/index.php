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
		$Val=strval(decbin(explode(" = ",$DataArray[$i])[1]));
		while(strlen($Val)<36){$Val="0".$Val;}
		for($j=0;$j<36;$j++){
			if($Mask[$j]!="X"){	
				$Val[$j]=$Mask[$j];
			}
			
		}
		$Var[$Key]=bindec($Val);
	}
}

echo array_sum($Var);
?>