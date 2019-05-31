<?php 
namespace Framework; 
require DBFOLDER.'helper_project_work.php'; 

class schema_project_work extends helper_project_work {

public $project_work_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $project_work_desc_validation = array('string','max'=>200,'min'=>1);

public $created_validation = array('timestamp');

public $insert_sql_statement;

public $update_sql_statement;

public $project_work_id;

public $project_work_desc;

public $created;

public $columns = array('project_work_id','project_work_desc','created');

}?>