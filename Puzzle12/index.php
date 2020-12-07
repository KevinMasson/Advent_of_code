<?php

$data = fopen('data.txt', 'r');
$Qlist = array();
$Tot=0;
while(!feof($data)){
	$ResponseData=array();
	$Line = trim(fgets($data));
	$Empty=0;
	while((strlen($Line))>0){
		$ResponseDataP=array();
		for($i=0;$i<strlen($Line);$i++){
			array_push($ResponseDataP,$Line[$i]);
		}
		if($Empty==0){
			if(empty($ResponseData)){
				$ResponseData=$ResponseDataP;
			}else{
				$ResponseData=array_intersect($ResponseData,$ResponseDataP);
			}
			if(empty($ResponseData)){
				$Empty=1;
			}
		}
		$Line = trim(fgets($data));
	}
	var_dump(implode($ResponseData));
	echo count($ResponseData)."<br>";
	$Tot+=count($ResponseData);
}

echo "total : ".$Tot;



?>