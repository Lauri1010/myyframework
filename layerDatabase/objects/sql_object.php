<?php
namespace Framework;

use DateTime;
use Exception;

class sql_object{
	
    public $binds;
	public $tableKeys;
	public $errorMessages;
	
	function __construct() {
		$this->binds=[];
		$this->tableKeys=[];
		$this->errorMessages=[];
	}
	
	public function setQueryKeys($table){
		if(is_string($table)){
			if(!in_array($value, $this->tableKeys)){
				$this->tableKeys[]=$table;
			}
		}
	}
	
	public function getRowFromSchema($tableName,$vName){
	    if(!empty($tableName) && !empty($vName)){
	        $this->setSchema($tableName);
	        $schemaName='schema_'.$tableName;
	        return $this->$schemaName->$vName;
	    }
	}
	
	public function validate($table,$sanitize=true,$sc=true){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$pArray=array();
			$vArray=array();
			$errors=false;
			
			if(isset($_POST)){
			             foreach ($_POST as $cName => $cValue) {
			                 if(is_string($cName)){
							    $this->setSchema($table);
							    $schemaName='schema_'.$table;
							    
										if($sanitize){
											$cValue=preg_replace("/<.*?>/", " ", $cValue);
										}
										if($sc){
											$cValue=htmlspecialchars($cValue,ENT_QUOTES);
										}
										$vName=$cName.'_validation';
										$rules=$this->$schemaName->$vName;
										if(!empty($rules)){
    										$vArray[$cName]= $this->getValidations($rules,$cName,$cValue);
    										if(empty($vArray[$cName])){
    										    $alias=':'.$cName;
        										if($rules[0]=='primary'){
        										    // TODO: Assumes this is auto incremented
        										    $this->binds[$alias]=null;
        										}else{
        										    $this->binds[$alias]=$cValue;
        										}
    										}else{
    										    $errors=true;
    										}
										}else{
										    trigger_error("table column name is improperly set in input element", E_USER_ERROR);
										}
							}
						}
						
						$crs='columns';
						$columns=$rules=$this->$schemaName->$crs;
						foreach($columns as $columnName){
						    
						}
						
						
						
						if($errors){
						  return $vArray;
						}else{
						  return false;  
						}
			}else{
				trigger_error("Submitting has to be with POST ", E_USER_ERROR);
			}
	
		}else{
			return false;	
		}		

	}
	

	protected function getValidations($rules,$column,$value,$insert=false,$validate=true){
	
		$errorMessages=array();
	
		if($insert){
			if(in_array('primary',$rules)){
				$validate=false;
			}
				
		}
	
		if($validate){
	
			foreach($rules as $rule){
	
				if($rule=='required'){
						
					if(empty($value)){
						$errorMessages[]=$column.' is required ';
					}
	
				}else if($rule=='intiger'){
						
					if(is_int($value)){
							
					}else{
							
						if(!ctype_digit($value)){
							$errorMessages[]=$column.' has to be an integer: ';
						}
	
					}
						
				}else if($rule=='decimal'){
	
					// echo '<p>Decimal column '.$column.$this->is_decimal($value).'    </p>';
					if(is_int($value)){
						// Intiger value is okay here
					}else{
	
						if(!is_numeric($value) && !floor($value)!=$value){
							$errorMessages[]=$column.' has to be a decimal ';

						}
	
					}
						
						
				}else if($rule=='string'){
					if(!is_string($value)){
						$errorMessages[]=$column.' has to be a string ';
					}
						
				}else if($rule=='date'){  // TODO: test this and impelent a view conversion
	
					$date = DateTime::createFromFormat('Y-d-m', $value);
					$dateErrors = DateTime::getLastErrors();
						
					if ($dateErrors['warning_count'] + $dateErrors['error_count'] > 0) {
						$errorMessages[] = $column.' needs to be a valid date! ';
					}
						
				}
	
			}
	
	
			if(isset($rules['max']) && isset($rules['min'])){
	
				$max=$rules['max'];
				$min=$rules['min'];
	
				if(is_string($value)){
					$lenght=strlen($value);
						
				}else{
					$lenght=strlen((string)$value);
				}
	
				if($lenght>=$max){
					$errorMessages[] = ' The maximum lenght for '. $column.' is '.$max.', current lenght is '.$lenght;
						
				}
	
			}
			
			return $errorMessages;
				
		}

	}
	
	protected function setSchema($table){
	
		try{
	
			$schemaName='schema_'.$table;
			$schemaCallClass='Framework\\'.$schemaName;
	
			if(!isset($this->{$schemaName})){
	
				$rt=DBFOLDER.$schemaName.'.php';
					
				if(is_file($rt)){
					require $rt;
					$this->{$schemaName}=new $schemaCallClass();
				}else{
					trigger_error("Class does not exist with path ".$rt, E_USER_ERROR);
				}
	
			}
	
		}catch (Exception $e) {
			trigger_error("Error in setting helper", E_USER_ERROR);
		}
	
	}
	
	
}