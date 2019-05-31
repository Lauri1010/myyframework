<?php
namespace Framework;

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'base_functions.php';

class hit extends base_functions{
	
	private $calledAction;

	function __construct() {
		$this->type='hit';
	
	}

	public function hit($language=null){

		$this->getLogic($this->type,__FUNCTION__);
		
		$this->af->processHit();
		
		
	}
	
	
	public function getHits($language=null){
		

		$this->getLogic($this->type,__FUNCTION__);
		
		require $this->getInternalPath(array('layerPages','views','hit','index.php'));
		

		
	}

	
	
	
}