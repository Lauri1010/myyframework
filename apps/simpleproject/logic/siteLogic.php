<?php
namespace Framework;
require FRPATH.'layerLogic'.DS.'backend.php';

class siteLogic extends backend{
	
    public $users;
    
	public function main(){
		
		
	}

	public function getUsers($lang='en',$parameters=array(),$key=__FUNCTION__){
	    $this->ds->q->selectColumns('user');
	    $this->ds->q->where('user','email',array('=','something'));
	    $this->users=$this->ds->queryDo(true);
	}
	
}