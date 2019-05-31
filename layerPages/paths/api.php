<?php
namespace Framework;

/***
 * The start of a path
 * Every capital letter means a new / in the URL path
 */

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'base_functions.php';

class api extends base_functions{
	
	private $calledAction;

	function __construct() {
		$this->type='api';

	}
	
	public function Index($language=null){
		
		$this->getLogic($this->type,__FUNCTION__);


	}
	
	
	
	
}