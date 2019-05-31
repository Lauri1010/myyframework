<?php
namespace Framework;
/**
 * @author Lauri Turunen
 * System level configs you can change. 
 * Run the console code generation tool before this. 
 * To change the app you need to adjust: define('SITE','name-of-your-webapp');
 * Also define DLOGIN for the default login page in case of expired session
 * and STIMEOUT for session timeout
 */
ini_set('session.use_only_cookies', 1); 
session_start();
$webapp=true;
$url=$_SERVER['REQUEST_URI'];
$host=$_SERVER['SERVER_NAME'];
if($host=='localhost'){
	define ('DEVELOPMENT_ENVIRONMENT',true);
	define('PROTOCOL','http://');
}else{
	define ('DEVELOPMENT_ENVIRONMENT',false);
	define('PROTOCOL','https://');
}
define('SHOST',$_SERVER['HTTP_HOST']);
define('SERVERNAME',$_SERVER['SERVER_NAME']);
define('DLOGIN','login');
define('STIMEOUT',60);
require 'bootstrap.php';
require FRPATH.'vendor'.DS.'autoload.php';
require FRPATH.'requestDispatchers'.DS.'base_dispatcher.php';
