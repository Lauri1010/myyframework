# myyframework php framework
php framework with advanced sql generation capabilities. With myyFramework you can make complex sql easily and fast and develop using a modular design with "get only what you need".
Note: this this is currently a work in progress, see below for details for participation in the project. This project is intended to be used with PHP 7.3

## To get started: 
1. Create a database (using heidi sql for instance) in mysql. 
2. Generate database schema mappings with console.php (examples in comments).  Remember to set the config in apps/your-app-name/config/config.php

## Some examples

**Conroller class mapped to spesific paths**

```php
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
```


**Product logic class used in pathing classes to do the actual business logic**

```php
class productLogic extends Backend{
	
	public $product;
	public $cartProduct;

	public function main(){
		
		
	}

	public function getProduct($lang='en',$parameters=array(),$key=__FUNCTION__){
		if(isset($parameters['r'])){
			
				$id=$parameters['r'];
				$key.=$id;
				$data=$this->ds->getFromAPCu($key);
				
				// Simulate an update to a database with spesific tables
				// $this->ds->setUpdated(array('product','product_category')); exit;
				
				if($this->ds->isUpdated(array('product','product_category'),$key) || empty($data)){
					$qo=$this->ds->getSqlObject();
					$qo->selectColumns('product');
					$qo->selectColumns('product_category',array('product_category_name'));
					$qo->joinFrom('product','JOIN','product_category');
					$qo->where('product','product_id',array('=',$id));
					$this->product=$this->ds->queryDo($qo,true);
					$this->ds->setToAPCu($key,$this->product);
				}else if(!empty($data)){
					$this->product=$data;	
				}else{
					trigger_error("Error in APCu caching", E_USER_ERROR);
				}

				return true;
				
 		}else{
			return false;
		} 

	}

	public function getProductCart($lang='en',$parameters=array(),$key=__FUNCTION__){
			if(isset($parameters['r'])){
				$id=$parameters['r'];
				$key.=$id;
				$data=$this->ds->getFromAPCu($key);
				
				if($this->ds->isUpdated(array('product'),$key) || empty($data)){
					$qo=$this->ds->getSqlObject();
					$qo->selectColumns('product');
					$qo->where('product','product_id',array('=',$id));
					$this->cartProduct=$this->ds->queryDo($qo,true);
					$this->ds->setToAPCu($key,$this->cartProduct);
				}else if(!empty($data)){
					$this->cartProduct=$data;
				}else{
					trigger_error("Error in APCu caching", E_USER_ERROR);
				}
				
				return true;
				
			
			}else{
				return false;
			}

	}
	
	public function setProduct(){
		
		$so=$this->ds->getSqlQueryObject('sqlObject');
		
		
	}
	
	
}
```
**View used to render and set the data from queries**
```php
<?php
namespace Framework;
if(Appdata::get('fReq')){
$title = "Test";
$metad = "Test";
require SNIPPLETS . 'head.php';
}
require SNIPPLETS.'menu.php';
?>
<div id="main">
	<div class="header">
		<h1>Hello world</h1>
		<h2></h2>
	</div>
	<div class="content">
		<?php 
		// foreach ($this->af->users as &$user) {
		//     echo $this->af->users["email"];
		//}
		?>
		<a href="http://localhost/data">Next page</a>
	</div>
</div>
<?php
if(Appdata::get('fReq')){require SNIPPLETS.'bottom.php';}
```
**Simple query**
```php
$this->ds->q->selectColumns('user');
$this->ds->q->where('user','email',array('=','something'));
$this->users=$this->ds->queryDo(true);
```
A more complex query with caching 
```php
if($this->ds->isUpdated(array('product','product_category'),$key) || empty($data)){
	$qo=$this->ds->getSqlObject();
	$qo->selectColumns('product');
	$qo->selectColumns('product_category',array('product_category_name'));
	$qo->joinFrom('product','JOIN','product_category');
	$qo->where('product','product_id',array('=',$id));
	$this->product=$this->ds->queryDo($qo,true);
	$this->ds->setToAPCu($key,$this->product);
}else if(!empty($data)){
	$this->product=$data;	
}else{
	trigger_error("Error in APCu caching", E_USER_ERROR);
}
```
**List of features**

- Database schema generation tool, generate.php in archetypes
- Easy to create archetypes for project templating
- Advanced SQL query generator with low footprint in terms of performance (works basically by constructing the query from blocks)
- Modular structure: path, logic and view files. Simple but easy to use pathing system

**List of unfinished features**
- Caching system finalizing. 
- ORM and Forms
- Pagination
- Translations
- Automatic form generation tool
- Sessions unfinished


