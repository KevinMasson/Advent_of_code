<?php

class PassportClass{

	public $IsValid = 1;
	public $byr;
	public $iyr;
	public $eyr;
	public $hgt;
	public $hcl;
	public $ecl;
	public $pid;
	public $cid;
	public $NeededFields = array("byr","iyr","eyr","hgt","hcl","ecl","pid");
	private $regexp_pid = "#[0-9]{9}#";
	private $pidLen=9;
	private $regexp_color = "#^\#[A-Za-z0-9]{6}$#";
	private $eclList=array("amb","blu","brn","gry","grn","hzl","oth");
	private $MesureList=array("cm","in");
	private $Param = array(
		"byr"=>array("min"=>1920,"max"=>2002),
		"iyr"=>array("min"=>2010,"max"=>2020),
		"eyr"=>array("min"=>2020,"max"=>2030),
		"hgt"=>array(
			"cm"=>array("min"=>150,"max"=>193),
			"in"=>array("min"=>59,"max"=>76)
			)
		);
			
	function __construct($datas){
		foreach ($datas as $key=>$value){
			$this->$key=$value;
		}
		$this->fisValid();
	}
	function fisValid(){
		$this->vFields();
		$this->vbyr();
		$this->viyr();
		$this->veyr();
		$this->vhgt();
		$this->vhcl();
		$this->vecl();
		$this->vpid();
		return $this->IsValid;
	}
	function vFields(){
		$OK=0;
		foreach ($this->NeededFields as $NeededField){
			if($this->$NeededField!=""){
				$OK++;
			}
		}
		if($OK!=count($this->NeededFields)){$this->IsValid=0;return false;}else{return true;}
	}
	function vbyr(){
		if(intval($this->byr)<$this->Param["byr"]["min"] || intval($this->byr)>$this->Param["byr"]["max"]){$this->IsValid=0;return false;}else{return true;}
	}
	function viyr(){
		if(intval($this->iyr)<$this->Param["iyr"]["min"] || intval($this->iyr)>$this->Param["iyr"]["max"] ){$this->IsValid=0;return false;}else{return true;}
	}
	function veyr(){
		if(intval($this->eyr)<$this->Param["eyr"]["min"] || intval($this->eyr)>$this->Param["eyr"]["max"]){$this->IsValid=0;return false;}else{return true;}
	}
	function vhgt(){
			$Mesure = strval(substr($this->hgt,-2,2));
			if(in_array($Mesure,$this->MesureList)){
				if(intval($this->hgt)<$this->Param["hgt"][$Mesure]["min"] || intval($this->hgt)>$this->Param["hgt"][$Mesure]["max"]){$this->IsValid=0;return false;}else{return true;}
			}else{
				$this->IsValid=0;
				return false;
			}
	}
	function vhcl(){
		preg_match($this->regexp_color,$this->hcl,$Match);
		if(count($Match)<1){$this->IsValid=0;return false;}else{return true;}
	}
	function vecl(){

		if(!in_array($this->ecl,$this->eclList)){$this->IsValid=0;return false;}else{return true;}
	}
	function vpid(){

		preg_match($this->regexp_pid,$this->pid,$Match);
		if(count($Match)<1 || strlen($this->pid)!=$this->pidLen){$this->IsValid=0;return false;}else{return true;}
	}
}


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
	$P=new PassportClass ($Passport);
	$Valid_Passorts+=$P->IsValid;
}
echo "passports valides : ".$Valid_Passorts;
?>