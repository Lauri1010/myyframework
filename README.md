# myyframework
php framework with advanced sql generation capabilities. 
With myyFramework you can make complex sql easily and fast and develop using a modular design with "get only what you need" (no database is set if needed, no bloated libraries on every request you do not need)

Includes the followong features
- Sql generation tool for most sql search queries (all join types, multiple join conditions). The tool generates the database mappings. Currently only works on mysql
- Router, Business logic. Built with principle of "dont need dont use". Modular structure
- Other unimplemented and unfinished features such as language translation, CMS. Automatic form generation, pagination tool

**Looking for developers to participate in the project as I do not have the time.**

Some examples


		Simple query
		```
	    $this->ds->q->selectColumns('user');
	    $this->ds->q->where('user','email',array('=','something'));
	    $this->users=$this->ds->queryDo(true);
		```
		A more complex query with caching 
		```
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

- Database schema generation tool, generate.php in archtypes
- Easy to create archtypes for project tempalting
- Advanced SQL query generator with low footprint in terms of performance (works basically by constructing the query from blocks)
- Modular structure: path, logic and view files. Simple but easy to use pathing system
		
**List of unfinished features**
- Sessions
- ORM and Forms
- Pagination
- Transaltions
- Automatic form generation tool

