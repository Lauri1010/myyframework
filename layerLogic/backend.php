<?php
namespace Framework;
use Exception;

/**
 * @author Lauri Turunen
 * 
 */
class backend{
	
	public $request;
	public $ds;
	public $rMethod;
	protected $view;
	public $data;
	public $validations=array();
	
	public function __construct(){
		$this->iniDatabaseService();
		$this->rMethod = $_SERVER['REQUEST_METHOD'];

	}
	
	public function iniDatabaseService(){
	    
	    if(empty($this->ds)){
	        
	        try {
	            
	            $requiredFile=DBFOLDER.'sql_service_'.DB_NAME.'.php';
	            if(is_file($requiredFile)){
	                require $requiredFile;
	            }else{
	                trigger_error($requiredFile." is not a file ", E_USER_ERROR);
	            }
	            
	            $dsName='Framework\\sql_service_'.DB_NAME;
	            $this->ds=new $dsName();
	            
	        }catch (Exception $e) {
	            trigger_error($e, E_USER_ERROR);
	        }
	    }
	    
	}

	public function login($username){
	
	
	
	}
	
	public function getStatus(){

	}


	
	public function redirect($url, $permanent = false)
	{
		header('Location: ' . $url, true, $permanent ? 301 : 302);
		exit();
	}

	
	
}
?>