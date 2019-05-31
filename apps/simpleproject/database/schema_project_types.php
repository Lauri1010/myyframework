<?php 
namespace Framework; 
require DBFOLDER.'helper_project_types.php'; 

class schema_project_types extends helper_project_types {

public $project_type_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $project_type_desc_validation = array('string','max'=>200,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $project_type_id;

public $project_type_desc;

public $columns = array('project_type_id','project_type_desc');

}?>