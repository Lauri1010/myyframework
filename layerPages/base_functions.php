<?php
/**
 * @author Lauri Turunen
 * The base functions level. This level functionality includes
 * - Authentication
 * - Authorization
 * - Response to given URl request
 * Note: that no access to database and backend logix is made in paths unless it is required (saves resources)
 * $this->getLogic($this->type,__FUNCTION__); in files under path
 * 
 */
namespace Framework;

class base_functions{
	
	protected $actionStart='';
	protected $pageValue;
	protected $ifg;
	protected $itemsPerPage=5;
	protected $page;
	protected $prevAction;
	private $calledAction;
	protected $af;
	protected $type;
	private $loggedIn;

	
	public function sanitize($data) {
	    $data = trim($data);
	    $data = htmlspecialchars($data);
	    $data = mysql_real_escape_string($data);
	    return $data;
	}
	
	public function isLoggedIn(){
        
	    
	}
	
	public function processUrl($urlElements,$lang=null,$homepage=false,$site=false,$rv=true) {
		
		if(is_array($urlElements)){
			reset($urlElements);
			$firstUrlElement=current($urlElements);
			$action=$this->getCallAction($urlElements,$site);
			if(method_exists($this, $action)){
				
				$r=array();
				if(isset($_GET['r']) && $rv){
						if($rv){$r['r']=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['r']);}else{
							$r['r']=$_GET['r'];
						}
						
				}

				if($_SERVER['REQUEST_METHOD'] === 'POST'){
					$p=array();
					foreach($_POST as $input => $value){
						$p[$input]=$value;
					}
					$r['p']=$p;
				}
				
				Appdata::set('r', $r);
				$this->$action($lang,$r);

				
			}else{
				// The last part of the URL is for item or query
/* 				if(empty($this->prevAction)){

				}else{ */
					$this->pageNotFoundAndExit();
				// }

			}
		}else{
			trigger_error("urlElements ".$urlElements." not an array! ", E_USER_ERROR);
		}
	}

	
	public function getCallAction($urlElements,$translate=false,$site=false){
		// we will dtermine what is requested based on the actions
		
		$callAction=$this->actionStart;
		
		$actionNotSet=true;
		
		$sizeofUrlElements=sizeof($urlElements);
		$lastElement=$sizeofUrlElements-1;
		
		// Should always start with the type
		$pElementPlace=$urlElements[$lastElement]; 
	
		
		if(is_numeric($pElementPlace)){
		
			$isDigit = ctype_digit((string)$pElementPlace);
			if($isDigit){
					
				$callAction.='Paginator';
				$this->page=$pElementPlace;
				
			}else{
				$this->pageNotFoundAndExit();
			}
		
		
		}
		
		// Removing the obvious type ULR part for convenience
		// $urlElements=array_splice($urlElements, 1, 1);

/* 		if(!$site){
			unset($urlElements[0]);
			
		} */
		$prevAction='';
		foreach($urlElements as $index => $urlElement){

				if(!is_numeric($urlElement)){
					if($actionNotSet){
						$callAction.=strtolower($urlElement);
						$actionNotSet=false;
					}else{
						$callAction.=ucfirst($urlElement);	
					}
					
/* 					if($index==$lastElement){
						break;
					}
					
					$prevAction.=$callAction; */
				}

		}
		
/* 		if(!empty($prevAction)){
			$this->prevAction=$prevAction;
		} */

		if (strpos($callAction,'?') !== false) {
			$callAction=substr($callAction, 0, strpos($callAction, "?"));
		}

		return $callAction;
			
	}
	
	/**
	 * Processing for patterns
	 * 
	 * */
	
	public function getPatterns(){
		
		
		
		
	}
	
	
	/**
	 * Automatically sets limit and offset
	 * 
	 * */
	public function paginator($page=1,$itemsPerPage=null){
		
		$offset=null;
		if(isset($this->itemsPerPage) && isset($this->page)){
	
			$limit=$this->itemsPerPage;
			if($this->page>1){
				$offset=($this->page*$this->itemsPerPage)-$this->itemsPerPage;
			}

		}else{
			
			die('Page and items per page has to be set!');
			
		}

		return array($limit,$offset);
		
	}
	
	
	
	
	/**
	 * URL path = the next level path beign used. 
	 * This feature assumed that pure is used
	 * */
	public function getNextPreviousPageLinks($page,$urlPath,$maxNumberOfPages){
		
		$previousPage=1;
		$nextPreviousPages=array();
		
		if($page==1){
			
			if($maxNumberOfPages==1){
				
			}else if($maxNumberOfPages>1){
				
				$nextPreviousPages[]="{$urlPath}/2";
				$nextPreviousPages[]="{$urlPath}/1";
				
			}
			
		}else if($page==2){

			// Next page path
			if($maxNumberOfPages==2){
				$nextPreviousPages[]="{$urlPath}/2";
			
			}

			
		}

		
	}
		

/* 	public function getPhpResource($requireType='require',$folder='lib'){
	
		if(empty($requireType)){
				
			die('require was empty!');
				
		}else{
			
			$requiredfile=ROOT.DS.FRFOLDER.DS.$folder.DS.'base_functions.php';
			
			if(is_file($requirePage)){
				
				if($requireType=='require'){
				
					$requiredfile=ROOT.DS.FRFOLDER.DS.$folder.DS.'base_functions.php';
				
				}else if($requireType=='require once'){
				
				
				}else if($requireType=='include'){
				
				
				}else if($requireType=='include once'){
				
				
				}
				
			}else{
			
				die('Cannot find the required file at base functions');
			
			}
			

				
		}
	
	} */
	

	public function getInternalPath($pathParts){
	
		$iPath=ROOT.DS.FRFOLDER;
	
		if(is_array($pathParts)){
				
			foreach($pathParts as $part){
	
				$iPath.=DS.$part;
	
			}
				
		}else{
			die('Path parts has to be an array!');
				
				
		}
	
		return $iPath;
	}
	
	public function printHeaders(){
		
/* 		header($this->response->status->get(), true, $this->response->status->getCode());
		
		// send non-cookie headers
		foreach ($this->response->headers->get() as $label => $value) {
			if (is_array($value)) {
				foreach ($value as $val) {
					header("{$label}: {$val}", false);
				}
			} else {
				header("{$label}: {$value}");
			}
		}
		
		foreach ($this->response->cookies->get() as $name => $cookie) {
			setcookie(
					$name,
					$cookie['value'],
					$cookie['expire'],
					$cookie['path'],
					$cookie['domain'],
					$cookie['secure'],
					$cookie['httponly']
					);
		}
		
		echo $this->response->content->get(); */
		
	}
	
	public function getView($type,$viewName){
	
		if(is_string($viewName) && is_string($type)){
			
			// $this->printHeaders();
			$classPath=strtolower($type);
			$vPath=VIEWSFOLDER.$type.DS.$viewName.'.php';

			if(is_file($vPath)){
				return $vPath;
			}else{
				trigger_error("View not found! ", E_USER_ERROR);
			}
		
		}else{
			trigger_error("View needs to be a string ", E_USER_ERROR);
		}

	}
	
	public function getLogic($type,$callMainFunction=true,$mainFunction='main'){

		if(is_string($type)){
			
			$logicName=$type.'Logic';
			
			$classPath=strtolower($type);
			
			$ra=LGFOLDER.$type.'Logic.php';
			
			if(is_file($ra)){
					
				require $ra;
				$cc='Framework\\'.$logicName;
				$this->af=new $cc;
					
				if($callMainFunction){
					$this->af->$mainFunction();
				}
			
			}else{
				die('Logic not found: '.$ra);
			
			}
			
		}

	}
	

	public function pageNotFound(){
		
		header("HTTP/1.0 404 Page not found");
		echo "<html><head></head>
					<body><h1>Page not found</h1>
					</body>
					</html>";

		
	}
	
	public function pageNotFoundAndExit(){
	
		header("HTTP/1.0 404 Page not found");
		echo "<html><head></head>
					<body><h1>Page not found</h1>
					</body>
					</html>";
	
		exit;
	
	}
	
	
	
}

