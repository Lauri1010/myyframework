<?php
namespace Framework;

require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'base_functions.php';

class actor extends base_functions{
	
	private $calledAction;
	private $type='site';

	public function actor($language=null){

		$this->getLogic($this->type,__FUNCTION__);

		// $this->af->getRecentPosts();
		
		$this->af->getActors();

		require $this->getInternalPath(array('layerPages','views','site','index.php'));
		
		
	}
	
	
	
	
}