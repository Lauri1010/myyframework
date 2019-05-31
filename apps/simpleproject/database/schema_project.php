<?php 
namespace Framework; 
require DBFOLDER.'helper_project.php'; 

class schema_project extends helper_project {

public $project_id_validation = array('required','intiger','max'=>10,'min'=>1);

public $project_name_validation = array('string','max'=>200,'min'=>1);

public $project_description_validation = array('string','max'=>200,'min'=>1);

public $project_type_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $created_upated_validation = array('timestamp');

public $status_validation = array('required','intiger','max'=>3,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $project_id;

public $project_name;

public $project_description;

public $project_type_ref;

public $created_upated;

public $status;

public $columns = array('project_id','project_name','project_description','project_type_ref','created_upated','status');

}?>