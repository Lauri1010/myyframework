<?php
namespace Framework;
/***
 * Do not remove or change this class
 *
 */
 
require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'base_functions.php';

class cms extends base_functions{

	private $calledAction;
	
	function __construct() {
		$this->type='cms';
	}

	public function cms(){
		$this->getLogic($this->type,__FUNCTION__);
		require $this->getInternalPath(array('layerPages','views','cms','submitProduct.php'));
	}
	
	public function cmsLogin(){
		$this->getLogic($this->type,__FUNCTION__);
		$this->af->authenticate('laupatrik@gmail.com','salainen');
		echo $this->af->isLoggedIn();
	}
	
	
}