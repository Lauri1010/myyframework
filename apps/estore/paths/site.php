<?php
namespace Framework;
require FRPATH.'layerPages'.DS.'base_functions.php';

class site extends base_functions{
	
	private $calledAction;

	function __construct() {
		$this->type='site';
		$this->getLogic($this->type,__FUNCTION__);
	
	}

	public function site($language=null,$parameters=array()){
		require $this->getView($this->type,'index');

	}
	
	public function data($language=null,$parameters=array()){
		// $this->getLogic($this->type,__FUNCTION__);
		require $this->getView($this->type,'nextpage');
	
	}
	
	public function error($language=null,$parameters=array()){
	    require $this->getView($this->type,'error');
	}
	
	
}