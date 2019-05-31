<?php
namespace Framework;
require FRPATH.'layerPages'.DS.'base_functions.php';

class site extends base_functions{
	
	private $calledAction;

	function __construct() {
		$this->type='site';
	
	}

	public function site($language=null,$parameters=array()){
	    $this->getLogic($this->type,__FUNCTION__);
	    // $this->af->getUsers();
	    require $this->getView($this->type,'index');
	}
	
	public function data($language=null,$parameters=array()){
		// $this->getLogic($this->type,__FUNCTION__);
		require $this->getView($this->type,'nextpage');
	
	}
	
	
}