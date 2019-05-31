# myyframework
php framework with advanced sql generation capabilities. With myyFramework you can make complex sql easily and fast and develop using a modular design with "get only what you need" 

Some examples

Simple query
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


