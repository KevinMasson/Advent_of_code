<?php

$data = fopen('data.txt', 'r');
$DataArray=array();
while(!feof($data)){
	$Line = fgets($data);
	array_push($DataArray, $Line);
}
$Ok=0;
for($i=0;$i<count($DataArray);$i++){
	$WorkTab=array();
	$WorkTab= explode(" ",$DataArray[$i]);
	//echo $WorkTab[0]." ".$WorkTab[2]." ".$WorkTab[2][(explode("-",$WorkTab[0])[0])+1]." ".$WorkTab[2][(explode("-",$WorkTab[0])[1])+1];
	$Letter=str_replace(":","",$WorkTab[1]);
	$Min=intval(trim(explode("-",$WorkTab[0])[0]-1));
	$Max=intval(trim(explode("-",$WorkTab[0])[1]-1));
	$len=strlen(trim($WorkTab[2]));echo $WorkTab[0]." ".$Min ." ".$Max." -- ".$Letter. " ////".trim($WorkTab[2])."/   ".$len." ";
	echo $WorkTab[2][$Min]. " --- ".$WorkTab[2][$Max]."     ";
	$diff=($len-$Max);
	if($len>=$Min){
		//if($Sup>=$len){
		if($diff>=0){
			$Letter1=$WorkTab[2][$Min];
			$Letter2=$WorkTab[2][$Max];
			if($Letter1!=$Letter2){
				if($Letter1==$Letter){
					echo "  OK Lettre 1";
					$Ok++;
				}else{
					if($Letter2==$Letter){
								echo "  OK Lettre 2";
						$Ok++;
					}else{
								echo "  KO";
					}
				}
			}else{
				echo "  KO same letter";
			}
		}else{
			echo "  Bad lenth max : ".$len;
		}
	}else{
		echo "  Bad lenth min : ".$len;
	}
	echo"<br>";
	

}
echo $Ok;


?>