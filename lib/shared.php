<?php
namespace Framework;
use DateTime;
/** Check if environment is development and display errors **/

function setReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors','On');
	} else {
	/* 	error_reporting(E_ALL);
		ini_set('display_errors','On'); */
	  	error_reporting(E_ALL & ~E_NOTICE);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log'); 
	}
}


/**
 * Setting APCu caching auto update table
 *
 */
/* function setAPCuSchema(){
	if(extension_loaded('apcu')){
		if (!apcu_exists('tRefresh')) {
			apcu_store('tUpdates',array());
		}
	}
	
} */

/**
 * Remove keys from APCu (Usually used when something has been updated to database). 
 *
 */
/* function refreshAPCuSchema(){
	if(extension_loaded('apcu')){
		if (apcu_exists('tRefresh')) {
			$rk=apcu_fetch('tRefresh');
			if(is_array($rk) && sizeof($rk)>0){
				foreach($rk as $key){
					if(is_string($key)){
						apcu_delete($key);
					}
				}
			}
		}
	}

} */

class Appdata{
	
	static private $data = array(
			'freq'=>SNIPPLETS,
			'r'=>''
	);
	
	static function get($index) {
		if(self::$data[$index]){
			return self::$data[$index];
		}else{
			return false;
		}

	}
	
	static function set($index,$data) {
		if(is_string($data) || is_bool($data)===true || is_bool($data)===false){
			self::$data[$index]=$data;
		}else{
			die('Only string data is supported!');
		}
	}
	
}

class validator{

	static function isInt($variable){
		return is_int($variable);
	
	}
	
	static function isDouble($variable){
		return is_double($variable);
	
	}
	
	static function checkIfNumeric($variable){
		return is_numeric($variable);
	
	}
	
	static function isIntUfilter($int){
		return filter_var($int, FILTER_VALIDATE_INT);
	
	}
	
	static function removeSepecialCharacters($string){
		if(is_string($string)){
	
			return filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	
		}

	}
	
	
	static function convertToInt($variable,$min=1,$max=11){
	
		/* 	if(!is_int($variable)){
	
		if(is_string($variable)){
			
		$stringLenght=strlen($variable);
			
		if($stringLenght >= $min && $stringLenght <= $max){
	
		$variable = (int) $variable;
	
		}
			
		}
	
		} */
	
		if(is_numeric($variable)){
	
			$variable = (int) $variable;
	
			return filter_var(
					$variable,
					FILTER_VALIDATE_INT,
					array(
							'options' => array(
									'min_range' => $min,
									'max_range' => $max
							)
					)
					);
	
		}else{
	
			return false;
	
		}
	
	}
	
	static function convertToFloat($variable,$min=1,$max=11){
	
		if(is_numeric($variable)){
	
			$variable = (float) $variable;
	
			return filter_var(
					$variable,
					FILTER_VALIDATE_FLOAT
					);
	
		}else{
	
			return false;
	
		}
	
	}
	
	static function intigerCheck($int, $min, $max){
	
		if (is_string($int) && !ctype_digit($int)) {
			return false; // contains non digit characters
		}
		if (!is_int((int) $int)) {
			return false; // other non-integer value or exceeds PHP_MAX_INT
		}
		return ($int >= $min && $int <= $max);
	}
	
	static function stringProperCheck($string,$min,$max){
		if (is_string($string)){
			$strinLenght=strlen($string);
			return ($strinLenght >= $min && $strinLenght <= $max);
	
		}else{
			return false;
		}
	
	}
	
	static function stringCheck($string, $type, $length){
	
		// assign the type
		$type = 'is_'.$type;
	
		if(!$type($string))
		{
			return FALSE;
		}
		// now we see if there is anything in the string
		elseif(empty($string))
		{
			return FALSE;
		}
		// then we check how long the string is
		elseif(strlen($string) > $length)
		{
			return FALSE;
		}
		else
		{
			// if all is well, we return TRUE
			return TRUE;
		}
	}
	
	static function stripTags($string){
		return strip_tags($string);
	
	}
	
	static function validateEmail($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	
	}
	
	static function hasWhitespace($string){
		return (preg_match('/\s/',$string));
	}
	
	static function checkdateFunction($month,$day,$year){
		return checkdate($month , $day , $year);
	
	}

	static function validateDate($date, $format = 'Y-m-d H:i:s'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	
}
setReporting();
if(!empty($_SESSION['authenticated'])){
    if(($_SESSION['authenticated']) == true) {
    
        if ((isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > STIMEOUT))) {
            
            session_destroy();
            session_unset();
            
            //redirect the user back to login page for re-authentication
            
            $redirectback = SERVERNAME.DS.DLOGIN;
            header(sprintf("Location: %s", $redirectback));
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }
}

?>