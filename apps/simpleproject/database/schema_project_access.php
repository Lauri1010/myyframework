<?php 
namespace Framework; 
require DBFOLDER.'helper_project_access.php'; 

class schema_project_access extends helper_project_access {

public $project_access_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $description_validation = array('string','max'=>200,'min'=>1);

public $write_access_validation = array('required','intiger','max'=>3,'min'=>1);

public $read_access_validation = array('required','intiger','max'=>3,'min'=>1);

public $update_access_validation = array('required','intiger','max'=>3,'min'=>1);

public $manage_access_validation = array('required','intiger','max'=>3,'min'=>1);

public $assignee_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $project_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $project_access_id;

public $description;

public $write_access;

public $read_access;

public $update_access;

public $manage_access;

public $assignee_id_ref;

public $project_id_ref;

public $columns = array('project_access_id','description','write_access','read_access','update_access','manage_access','assignee_id_ref','project_id_ref');

}?>