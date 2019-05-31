<?php
namespace Framework;

/**
 * You can set your config variables here
 *
 */
class config {
	
	static private $conf = array(
			'snipplets'=>SNIPPLETS
	);
	
	static function init(){
		
		if(DEVELOPMENT_ENVIRONMENT){
			self::$conf['dbHost']='localhost';
			self::$conf['dbUser']='main';
			self::$conf['dbPass']='UVjc9b4ahSo3uCMy';
			self::$conf['dbName']='products_database';
		}else{
			self::$conf['dbHost']='';
			self::$conf['dbUser']='';
			self::$conf['dbPass']='';
			self::$conf['dbName']='';
		}
		
	}

	static function getConf($index) {
		return self::$conf[$index];
	}
	

}
?>